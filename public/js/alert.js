function selctedAlert(alertType) {
    var alertContainer = $("#alert-container");
    if ($("div#ignition").length > 0) {
        $(document)
            .find("#ignition")
            .remove();
    } else {
        $(document)
            .find(".message-alert")
            .remove();
    }
    switch (alertType) {
        case "1": // POWER
            alertContainer.append(
                '<div  id="ignition">' +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Power Alert Message :</label>' +
                    '<textarea class="form-control" name="power_message" placeholder="Type alert message.."></textarea>' +
                    "</div>" +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Power Status :</label>' +
                    '<div class="kt-radio-inline">' +
                    '<label class="kt-radio">' +
                    '<input type="radio" name="power_status" value="1" /> Connected' +
                    "<span></span></label>" +
                    '<label class="kt-radio">' +
                    '<input type="radio" name="power_status" value="2" /> Disconnected' +
                    "<span></span></label>" +
                    '<label class="kt-radio">' +
                    '<input type="radio" name="power_status" value="3" /> Both' +
                    "<span></span></label>" +
                    "</div>" +
                    "</div>" +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Choose Alert Method :</label>' +
                    '<div class="kt-checkbox-inline pt-3">' +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="power_alert_method[]" value="1" onclick="onAlertCheck(1)" /> EMAIL' +
                    "<span></span></label>" +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="power_alert_method[]" value="2" onclick="onAlertCheck(2)" /> SMS' +
                    "<span></span></label>" +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="power_alert_method[]" value="3" onclick="onAlertCheck(3)" /> NOTIFICATION' +
                    "<span></span></label>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            );
            break;
        case "2": // SOS
            alertContainer.append(
                '<div  id="ignition">' +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">SOS Alert Message :</label>' +
                    '<div class="kt-checkbox-inline">' +
                    '<textarea class="form-control" name="sos_message" placeholder="Type SOS message..">SOS</textarea>' +
                    "</div>" +
                    "</div>" +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Choose Alert Method :</label>' +
                    '<div class="kt-checkbox-inline">' +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="sos_alert_method[]" value="1" onclick="onAlertCheck(1)" /> EMAIL' +
                    "<span></span></label>" +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="sos_alert_method[]" value="2" onclick="onAlertCheck(2)" /> SMS' +
                    "<span></span></label>" +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="sos_alert_method[]" value="3" onclick="onAlertCheck(3)" /> NOTIFICATION' +
                    "<span></span></label>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            );
            break;
        case "3": // Ignition On
            alertContainer.append(
                '<div  id="ignition">' +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Ignition Alert Text</label>' +
                    '<textarea class="form-control" name="ign_alert_text" placeholder="Type alert message.."></textarea>' +
                    "</div>" +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Ignition Alert Type :</label>' +
                    '<div class="kt-radio-inline">' +
                    '<label class="kt-radio">' +
                    '<input type="radio" name="ign_status" value="1" /> IGNITION ON' +
                    "<span></span></label>" +
                    '<label class="kt-radio">' +
                    '<input type="radio" name="ign_status" value="2" /> IGNITION OFF' +
                    "<span></span></label>" +
                    '<label class="kt-radio">' +
                    '<input type="radio" name="ign_status" value="3" /> Both' +
                    "<span></span></label>" +
                    "</div>" +
                    "</div>" +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Choose Alert Method :</label>' +
                    '<div class="kt-checkbox-inline">' +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="ign_alert_method[]" value="1" onclick="onAlertCheck(1)" /> EMAIL' +
                    "<span></span></label>" +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="ign_alert_method[]" value="2" onclick="onAlertCheck(2)" /> SMS' +
                    "<span></span></label>" +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="ign_alert_method[]" value="3" onclick="onAlertCheck(3)" /> NOTIFICATION' +
                    "<span></span></label>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            );
            break;
        case "4": // Over Speed
            alertContainer.append(
                '<div  id="ignition">' +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Over Speed Parameter :</label>' +
                    '<input type="number" class="form-control" name="os_parameter" placeholder="Over Speed greater than.." />' +
                    "</div>" +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Over Speed Duration (Minutes) :</label>' +
                    '<input type="number" class="form-control" name="os_duration" placeholder="Enter duration in minutes.." />' +
                    "</div>" +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Over Speed Alert Text</label>' +
                    '<textarea class="form-control" name="os_alert_text" placeholder="Type alert message.." ></textarea>' +
                    "</div>" +
                    '<div class="form-group">' +
                    '<label for="exampleSelect1">Choose Alert Method :</label>' +
                    '<div class="kt-checkbox-inline">' +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="os_alert_method[]" value="1" onclick="onAlertCheck(1)" /> EMAIL' +
                    "<span></span></label>" +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="os_alert_method[]" value="2" onclick="onAlertCheck(2)" /> SMS' +
                    "<span></span></label>" +
                    '<label class="kt-checkbox">' +
                    '<input type="checkbox" name="os_alert_method[]" value="3" onclick="onAlertCheck(3)" /> NOTIFICATION' +
                    "<span></span></label>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            );
            break;
        default:
            // Empty Alert Container
            alertContainer.append(
                '<div class="card card-body bg-secondary message-alert">' +
                    "This alert is not available yet!" +
                    "<div>"
            );
            break;
    }
}

function onAlertCheck(checked) {
    var alertContainer = $("#ignition");
    switch (checked) {
        case 1:
            if ($("#alert-ign-on-email").length > 0) {
                $(document)
                    .find("#alert-ign-on-email")
                    .remove();
            } else {
                alertContainer.append(
                    '<div class="form-group" id="alert-ign-on-email">' +
                        '<label for="alert_ign_on_email">Email Addesses</label>' +
                        '<textarea class="form-control" name="alert_ign_on_email" placeholder="Type comma (,) saperated email addresses.."></textarea>' +
                        "</div>"
                );
            }
            break;
        case 2:
            if ($("#alert-ign-on-sms").length > 0) {
                $(document)
                    .find("#alert-ign-on-sms")
                    .remove();
            } else {
                alertContainer.append(
                    '<div class="form-group" id="alert-ign-on-sms">' +
                        '<label for="alert_ign_on_mobile">Mobile Numbers</label>' +
                        '<textarea class="form-control" name="alert_ign_on_mobile" placeholder="Type comma (,) saperated mobile numbers.."></textarea>' +
                        "</div>"
                );
            }
            break;
        default:
            if ($("#alert-ign-on-notifications").length > 0) {
                $(document)
                    .find("#alert-ign-on-notifications")
                    .remove();
            } else {
                let options = [];
                for (let i = 1; i < 9; i++) {
                    options.push(
                        '<option value="' + i + '">Sound ' + i + "</option>"
                    );
                }
                alertContainer.append(
                    '<div class="form-group" id="alert-ign-on-notifications">' +
                        '<label for="alert_ign_on_mobile">Notification Sounds</label>' +
                        '<select class="form-control" name="alert_ign_on_notification" onchange="playSound($(this).val())">' +
                        options +
                        "</select>" +
                        "</div>"
                );
            }
            break;
    }
}

function playSound(sound) {
    let soundURL = "/sounds/sound-" + sound + ".wav";
    var audio = new Audio(soundURL);
    audio.play();
}
