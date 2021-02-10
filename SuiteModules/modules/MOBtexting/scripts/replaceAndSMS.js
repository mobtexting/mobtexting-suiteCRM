var phones = $('[type=phone]');
var baseUrl = window.siteUrl;
for (i = 0; i < phones.length; i++) {
    var phone = $(phones[i]);
    var callerButton = $(phone).attr('sms-button');
    if (callerButton === undefined) {
        var number = phone.text().trim();
        if (number != "") {
            phone.append('<img src="' + baseUrl + '/themes/SuiteP/images/p_icon_email_address_32.png" alt="to call" class="send-MOBtexting-sms" data-number="' + number + '" />');
            $(phone).attr('sms-button', true);
        }
    }
}
$('img.send-MOBtexting-sms:not(.binded)').addClass('binded').on('click', function() {
    var number = $(this).attr('data-number'); //list number
    phonenumber(number);
    // if(isNaN(number))
    // {
    //   apiResponseMessage("error","Phone Number Not valid","Please Register a valid phone number");
    //   return fasle;
    // }
    Swal.fire({
        title: number,
        text: "Write something interesting:",
        input: 'textarea',
        showCancelButton: true
    }).then((result) => {
        if (result.value) {
            var fullurl = baseUrl + '/index.php?entryPoint=MOBtexting';
            $.ajax({
                type: "POST",
                dataType: "json",
                url: fullurl,
                data: {
                    ext: window.extension,
                    num: number,
                    message: result.value
                },
                success: function(e) {
                    console.log(e);
                    if (e['status'] == "ERROR" && e['code'] == 422) {
                        let message = e['message'];
                        apiResponseMessage('error', 'Oops', message);
                    }
                    if (e['status'] == 200) {
                        let message = "Message Sent";
                        apiResponseMessage('success', 'success', message);
                    }
                    if (e['status'] == 201) {
                        let message = "Access Token Invalid!";
                        apiResponseMessage('error', 'Error', message);
                    }
                    if (e['status'] == 505) {
                        let message = e['message'];
                        apiResponseMessage('error', 'Error', message);
                    }
                    return false;
                }
            });
        } else {
            apiResponseMessage("error", "Message's empty ", "Please Enter you'r Messages");
            return false;
        }
    });
});
//number validation
function phonenumber(number) {
    var phoneno = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    if (number.match(phoneno)) {
        return true;
    } else {
        apiResponseMessage("error", "Phone Number Not valid", "Please Register a valid phone number");
        return fasle;
    }
}

function apiResponseMessage(icon, title, message) {
    Swal.fire({
        icon: icon,
        title: title,
        text: message,
        // footer: '<a href>Why do I have this issue?</a>'
    })
}