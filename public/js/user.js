"use strict";
// Show Password
function showPassword() {
    var array1 = $('input[name="password"]');
    var array2 = $('input[name="confirm_password"]');
    var array3 = $('input[name="branch_password"]');
    var array4 = $('input[name="branch_confirm_password"]');
    var passwordFields = $.merge(
        array1,
        $.merge(array2, $.merge(array3, array4))
    );
    passwordFields.each(function(i, element) {
        if (element.type === "password") {
            element.type = "text";
            $(".flaticon-eye").addClass("text-dark");
        } else {
            element.type = "password";
            $(".flaticon-eye").removeClass("text-dark");
        }
    });
}
var KTAddUser = (function() {
    var t,
        e = KTUtil.getByID("add_user");
    return {
        init: function() {
            !(function() {
                t = new KTOffcanvas(e, {
                    overlay: !0,
                    baseClass: "kt-demo-panel",
                    closeBy: "kt_demo_panel_close",
                    toggleBy: "kt_demo_panel_toggle"
                });
                var n = KTUtil.find(e, ".kt-demo-panel__head"),
                    i = KTUtil.find(e, ".kt-demo-panel__body");
                KTUtil.scrollInit(i, {
                    disableForMobile: !0,
                    resetHeightOnDestroy: !0,
                    handleWindowResize: !0,
                    height: function() {
                        var t = parseInt(KTUtil.getViewPort().height);
                        return (
                            n &&
                                ((t -= parseInt(KTUtil.actualHeight(n))),
                                (t -= parseInt(KTUtil.css(n, "marginBottom")))),
                            (t -= parseInt(KTUtil.css(e, "paddingTop"))),
                            (t -= parseInt(KTUtil.css(e, "paddingBottom")))
                        );
                    }
                }),
                    void 0 !== t &&
                        0 === t.length &&
                        t.on("hide", function() {
                            var t = new Date(new Date().getTime() + 36e5);
                            Cookies.set("kt_demo_panel_shown", 1, {
                                expires: t
                            });
                        });
            })();
        }
    };
})();
$(document).ready(function() {
    $("#add_user").click(function() {
        KTAddUser.init();
    });

    $(".select2").select2();
    /******** Validations *********/

    $(".kt-avatar__holder").css(
        "background-image",
        "url('../img/user_image.png')"
    );
    // Sort Name Validation
    $(".name_validate").click(function() {
        if ($("#name").val() == "") {
            if ($(".form_group__name div.error").length != 1) {
                $(".form_group__name input")
                    .addClass("is-invalid")
                    .attr("aria-invalid", "true");
                $(".form_group__name").append(
                    '<div class="error invalid-feedback">Please note name is a required field.</div>'
                );
            }
        }
    });
    $("#name").keyup(function() {
        if ($("#name").val() != "") {
            $(".form_group__name input")
                .removeClass("is-invalid")
                .attr("aria-invalid", "false");
            $(".form_group__name div.error").detach();
            if ($(".form_group__name div.error").length != 1) {
                $(".form_group__name input")
                    .addClass("is-invalid")
                    .attr("aria-invalid", "true");
                $(".form_group__name").append(
                    '<div class="error invalid-feedback">Please note name is a required field.</div>'
                );
            }
        }
    });
    // Sort Name Validation Ends

    // User Password Validation
    $(".name_validate").click(function() {
        if ($("#name").val() == "") {
            if ($(".form_group__name div.error").length != 1) {
                $(".form_group__name input")
                    .addClass("is-invalid")
                    .attr("aria-invalid", "true");
                $(".form_group__name").append(
                    '<div class="error invalid-feedback">Please note name is a required field.</div>'
                );
            }
        }
    });
    $("#name").keyup(function() {
        if ($("#name").val() != "") {
            if ($(".form_group__name div.error").length == 1) {
                $(".form_group__name input")
                    .removeClass("is-invalid")
                    .attr("aria-invalid", "false");
                $(".form_group__name div.error").detach();
                // console.log('name with value');
            }
        } else {
            $(".form_group__name input")
                .addClass("is-invalid")
                .attr("aria-invalid", "true");
            $(".form_group__name").append(
                '<div class="error invalid-feedback">Please note name is a required field.</div>'
            );
        }
    });
    // User Password Validation Ends

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".kt-avatar__holder").css(
                    "background-image",
                    "url(" + e.target.result + ")"
                );
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#profile_image").change(function() {
        readURL(this);
    });

    /******** Validations Ends *********/

    /**
     *
     * Branches
     *
     */

    if ($("#branches").length > 0) {
        $(
            'input[name="name"],' +
                'input[name="user_name"],' +
                'input[name="contact_person"],' +
                'input[name="mobile_number"],' +
                'input[name="telephone_number"],' +
                'input[name="fax_number"],' +
                'input[name="zip_code"],' +
                'textarea[name="full_address"]'
        ).on("keyup", function() {
            $('input[name="branch_name"]').val($('input[name="name"]').val());
            $('input[name="branch_email"]').val(
                "branch_" + $('input[name="user_name"]').val()
            );
            $('input[name="branch_user_name"]').val(
                "branch_" + $('input[name="user_name"]').val()
            );
            $('input[name="branch_contact_person"]').val(
                $('input[name="contact_person"]').val()
            );
            $('input[name="branch_mobile_number"]').val(
                $('input[name="mobile_number"]').val()
            );
            $('input[name="branch_telephone_number"]').val(
                $('input[name="telephone_number"]').val()
            );
            $('input[name="branch_fax_number"]').val(
                $('input[name="fax_number"]').val()
            );
            $('input[name="branch_zip_code"]').val(
                $('input[name="zip_code"]').val()
            );
            $('textarea[name="branch_full_address"]').val(
                $('textarea[name="full_address"]').val()
            );
        });
        var state = $('select[name="state"]');
        var city = $('select[name="city"]');
        var country = $('select[name="country"]');
        state.on("select2:selecting", function(e) {
            console.log($('select[name="state"]').val());

            $(
                "select[name='branch_state'] option[value='" +
                    $('select[name="state"]').val() +
                    "']"
            ).attr("selected", "selected");
        });
        city.on("select2:selecting", function(e) {
            console.log($('select[name="city"]').val());

            $(
                "select[name='branch_city'] option[value='" +
                    $('select[name="city"]').val() +
                    "']"
            ).attr("selected", "selected");
        });
        country.on("select2:selecting", function(e) {
            console.log($('select[name="country"]').val());

            $(
                "select[name='branch_state'] option[value='" +
                    $('select[name="state"]').val() +
                    "']"
            ).attr("selected", "selected");
        });
    }
});
