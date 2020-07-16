"use strict";
var KTDemoPanel = (function() {
    var t,
        e = KTUtil.getByID("kt_demo_panel");
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
            })(),
                ("keenthemes.com" != encodeURI(window.location.hostname) &&
                    "www.keenthemes.com" !=
                        encodeURI(window.location.hostname)) ||
                    setTimeout(function() {
                        if (!Cookies.get("kt_demo_panel_shown")) {
                            var e = new Date(new Date().getTime() + 9e5);
                            Cookies.set("kt_demo_panel_shown", 1, {
                                expires: e
                            }),
                                t.show();
                        }
                    }, 4e3);
        }
    };
})();
$(document).ready(function() {
    $("#kt_form_button").click(function() {
        KTDemoPanel.init();
    });
});
var KTQuickPanel = (function() {
    var t = KTUtil.get("kt_quick_panel"),
        e = KTUtil.get("kt_quick_panel_tab_notifications"),
        n = KTUtil.get("kt_quick_panel_tab_logs"),
        i = KTUtil.get("kt_quick_panel_tab_settings"),
        a = function() {
            var e = KTUtil.find(t, ".kt-quick-panel__nav");
            KTUtil.find(t, ".kt-quick-panel__content");
            return (
                parseInt(KTUtil.getViewPort().height) -
                parseInt(KTUtil.actualHeight(e)) -
                2 * parseInt(KTUtil.css(e, "padding-top")) -
                10
            );
        };
    return {
        init: function() {
            new KTOffcanvas(t, {
                overlay: !0,
                baseClass: "kt-quick-panel",
                closeBy: "kt_quick_panel_close_btn",
                toggleBy: "kt_quick_panel_toggler_btn"
            }),
                KTUtil.scrollInit(e, {
                    disableForMobile: !0,
                    resetHeightOnDestroy: !0,
                    handleWindowResize: !0,
                    height: function() {
                        return a();
                    }
                }),
                KTUtil.scrollInit(n, {
                    disableForMobile: !0,
                    resetHeightOnDestroy: !0,
                    handleWindowResize: !0,
                    height: function() {
                        return a();
                    }
                }),
                KTUtil.scrollInit(i, {
                    disableForMobile: !0,
                    resetHeightOnDestroy: !0,
                    handleWindowResize: !0,
                    height: function() {
                        return a();
                    }
                }),
                $(t)
                    .find('a[data-toggle="tab"]')
                    .on("shown.bs.tab", function(t) {
                        KTUtil.scrollUpdate(e),
                            KTUtil.scrollUpdate(n),
                            KTUtil.scrollUpdate(i);
                    });
        }
    };
})();
var KTFormPanel = (function() {
    var t = KTUtil.get("kt_form_container"),
        e = KTUtil.get("kt_quick_panel_tab_notifications"),
        n = KTUtil.get("kt_quick_panel_tab_logs"),
        i = KTUtil.get("kt_quick_panel_tab_settings"),
        a = function() {
            var e = KTUtil.find(t, ".kt-quick-panel__nav");
            KTUtil.find(t, ".kt-quick-panel__content");
            return (
                parseInt(KTUtil.getViewPort().height) -
                parseInt(KTUtil.actualHeight(e)) -
                2 * parseInt(KTUtil.css(e, "padding-top")) -
                10
            );
        };
    return {
        init: function() {
            new KTOffcanvas(t, {
                overlay: !0,
                baseClass: "kt-quick-panel",
                closeBy: "kt_quick_panel_close_btn",
                toggleBy: "kt_quick_panel_toggler_btn"
            }),
                KTUtil.scrollInit(e, {
                    disableForMobile: !0,
                    resetHeightOnDestroy: !0,
                    handleWindowResize: !0,
                    height: function() {
                        return a();
                    }
                }),
                KTUtil.scrollInit(n, {
                    disableForMobile: !0,
                    resetHeightOnDestroy: !0,
                    handleWindowResize: !0,
                    height: function() {
                        return a();
                    }
                }),
                KTUtil.scrollInit(i, {
                    disableForMobile: !0,
                    resetHeightOnDestroy: !0,
                    handleWindowResize: !0,
                    height: function() {
                        return a();
                    }
                }),
                $(t)
                    .find('a[data-toggle="tab"]')
                    .on("shown.bs.tab", function(t) {
                        KTUtil.scrollUpdate(e),
                            KTUtil.scrollUpdate(n),
                            KTUtil.scrollUpdate(i);
                    });
        }
    };
})();
$(document).ready(function() {
    KTQuickPanel.init();
    KTFormPanel.init();
});
