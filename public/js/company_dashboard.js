"use strict";
var KTDashboard = (function() {
    var Running = $("#Vehicle_Summery_Running").attr("data");
    var Idle = $("#Vehicle_Summery_Idle").attr("data");
    var Stop = $("#Vehicle_Summery_Stop").attr("data");
    var Inactive = $("#Vehicle_Summery_Inactive").attr("data");
    var NoData = $("#Vehicle_Summery_NoData").attr("data");

    var CompanyDistance_0_50 = $("#CompanyDistance_0_50").attr("data");
    var CompanyDistance_50_100 = $("#CompanyDistance_50_100").attr("data");
    var CompanyDistance_100_200 = $("#CompanyDistance_100_200").attr("data");
    var CompanyDistance_200_500 = $("#CompanyDistance_200_500").attr("data");
    var CompanyDistance_500 = $("#CompanyDistance_500").attr("data");

    var t = function(t, e, a, r) {
        if (0 != t.length) {
            var o = {
                type: "line",
                data: {
                    labels: [
                        "MONM",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October"
                    ],
                    datasets: [
                        {
                            label: "",
                            borderColor: a,
                            borderWidth: r,
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 12,
                            pointBackgroundColor: Chart.helpers
                                .color("#000000")
                                .alpha(0)
                                .rgbString(),
                            pointBorderColor: Chart.helpers
                                .color("#000000")
                                .alpha(0)
                                .rgbString(),
                            pointHoverBackgroundColor: KTApp.getStateColor(
                                "danger"
                            ),
                            pointHoverBorderColor: Chart.helpers
                                .color("#000000")
                                .alpha(0.1)
                                .rgbString(),
                            fill: !1,
                            data: e
                        }
                    ]
                },
                options: {
                    title: { display: !1 },
                    tooltips: {
                        enabled: !1,
                        intersect: !1,
                        mode: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: { display: !1, labels: { usePointStyle: !1 } },
                    responsive: !0,
                    maintainAspectRatio: !0,
                    hover: { mode: "index" },
                    scales: {
                        xAxes: [
                            {
                                display: !1,
                                gridLines: !1,
                                scaleLabel: {
                                    display: !0,
                                    labelString: "Month"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                display: !1,
                                gridLines: !1,
                                scaleLabel: {
                                    display: !0,
                                    labelString: "Value"
                                },
                                ticks: { beginAtZero: !0 }
                            }
                        ]
                    },
                    elements: { point: { radius: 4, borderWidth: 12 } },
                    layout: {
                        padding: { left: 0, right: 10, top: 5, bottom: 0 }
                    }
                }
            };
            return new Chart(t, o);
        }
    };
    return {
        init: function() {
            var e, a;
            !(function() {
                var t = KTUtil.getByID("kt_chart_daily_sales");
                if (t) {
                    var e = {
                        labels: [
                            "Label 1",
                            "Label 2",
                            "Label 3",
                            "Label 4",
                            "Label 5",
                            "Label 6",
                            "Label 7",
                            "Label 8",
                            "Label 9",
                            "Label 10",
                            "Label 11",
                            "Label 12",
                            "Label 13",
                            "Label 14",
                            "Label 15",
                            "Label 16"
                        ],
                        datasets: [
                            {
                                backgroundColor: KTApp.getStateColor("success")
                            },
                            {
                                backgroundColor: "#f3f3fb"
                            }
                        ]
                    };
                    new Chart(t, {
                        type: "bar",
                        data: e,
                        options: {
                            title: { display: !1 },
                            tooltips: {
                                intersect: !1,
                                mode: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            legend: { display: !1 },
                            responsive: !0,
                            maintainAspectRatio: !1,
                            barRadius: 4,
                            scales: {
                                xAxes: [
                                    { display: !1, gridLines: !1, stacked: !0 }
                                ],
                                yAxes: [
                                    { display: !1, stacked: !0, gridLines: !1 }
                                ]
                            },
                            layout: {
                                padding: {
                                    left: 0,
                                    right: 0,
                                    top: 0,
                                    bottom: 0
                                }
                            }
                        }
                    });
                }
            })(),
                (function() {
                    if (KTUtil.getByID("vehicle_summery_company")) {
                        var t = {
                                type: "doughnut",
                                data: {
                                    datasets: [
                                        {
                                            data: [
                                                Running,
                                                Idle,
                                                Stop,
                                                Inactive,
                                                NoData
                                            ],
                                            backgroundColor: [
                                                KTApp.getStateColor("success"),
                                                KTApp.getStateColor("warning"),
                                                KTApp.getStateColor("danger"),
                                                "#770073",
                                                KTApp.getStateColor("secondary")
                                            ]
                                        }
                                    ],
                                    labels: [
                                        "RUNNING",
                                        "IDLE",
                                        "STOP",
                                        "INACTIVE",
                                        "NO DATA"
                                    ]
                                },
                                options: {
                                    cutoutPercentage: 20,
                                    responsive: !0,
                                    maintainAspectRatio: !1,
                                    legend: { display: !1, position: "top" },
                                    title: { display: !1, text: "Technology" },
                                    animation: {
                                        animateScale: !0,
                                        animateRotate: !0
                                    },
                                    tooltips: {
                                        enabled: !0,
                                        intersect: !1,
                                        mode: "nearest",
                                        bodySpacing: 5,
                                        yPadding: 10,
                                        xPadding: 10,
                                        caretPadding: 0,
                                        displayColors: !1,
                                        backgroundColor: KTApp.getStateColor(
                                            "brand"
                                        ),
                                        titleFontColor: "#ffffff",
                                        cornerRadius: 4,
                                        footerSpacing: 0,
                                        titleSpacing: 0
                                    }
                                }
                            },
                            e = KTUtil.getByID(
                                "vehicle_summery_company"
                            ).getContext("2d");
                        new Chart(e, t);
                    }
                })(),
                (function() {
                    if (KTUtil.getByID("kt_chart_sales_stats")) {
                        var t = {
                            type: "line",
                            data: {
                                labels: [
                                    "January",
                                    "February",
                                    "March",
                                    "April",
                                    "May",
                                    "June",
                                    "July",
                                    "August",
                                    "September",
                                    "October",
                                    "November",
                                    "December",
                                    "January",
                                    "February",
                                    "March",
                                    "April"
                                ],
                                datasets: [
                                    {
                                        label: "Sales Stats",
                                        borderColor: KTApp.getStateColor(
                                            "brand"
                                        ),
                                        borderWidth: 2,
                                        backgroundColor: KTApp.getStateColor(
                                            "brand"
                                        ),
                                        pointBackgroundColor: Chart.helpers
                                            .color("#ffffff")
                                            .alpha(0)
                                            .rgbString(),
                                        pointBorderColor: Chart.helpers
                                            .color("#ffffff")
                                            .alpha(0)
                                            .rgbString(),
                                        pointHoverBackgroundColor: KTApp.getStateColor(
                                            "danger"
                                        ),
                                        pointHoverBorderColor: Chart.helpers
                                            .color(
                                                KTApp.getStateColor("danger")
                                            )
                                            .alpha(0.2)
                                            .rgbString(),
                                        data: [
                                            10,
                                            20,
                                            16,
                                            18,
                                            12,
                                            40,
                                            35,
                                            30,
                                            33,
                                            34,
                                            45,
                                            40,
                                            60,
                                            55,
                                            70,
                                            65,
                                            75,
                                            62
                                        ]
                                    }
                                ]
                            },
                            options: {
                                title: { display: !1 },
                                tooltips: {
                                    intersect: !1,
                                    mode: "nearest",
                                    xPadding: 10,
                                    yPadding: 10,
                                    caretPadding: 10
                                },
                                legend: {
                                    display: !1,
                                    labels: { usePointStyle: !1 }
                                },
                                responsive: !0,
                                maintainAspectRatio: !1,
                                hover: { mode: "index" },
                                scales: {
                                    xAxes: [
                                        {
                                            display: !1,
                                            gridLines: !1,
                                            scaleLabel: {
                                                display: !0,
                                                labelString: "Month"
                                            }
                                        }
                                    ],
                                    yAxes: [
                                        {
                                            display: !1,
                                            gridLines: !1,
                                            scaleLabel: {
                                                display: !0,
                                                labelString: "Value"
                                            }
                                        }
                                    ]
                                },
                                elements: {
                                    point: {
                                        radius: 3,
                                        borderWidth: 0,
                                        hoverRadius: 8,
                                        hoverBorderWidth: 2
                                    }
                                }
                            }
                        };
                        new Chart(KTUtil.getByID("kt_chart_sales_stats"), t);
                    }
                })(),
                t(
                    $("#kt_chart_sales_by_apps_1_1"),
                    [10, 20, -5, 8, -20, -2, -4, 15, 5, 8],
                    KTApp.getStateColor("success"),
                    2
                ),
                t(
                    $("#kt_chart_sales_by_apps_1_2"),
                    [2, 16, 0, 12, 22, 5, -10, 5, 15, 2],
                    KTApp.getStateColor("danger"),
                    2
                ),
                t(
                    $("#kt_chart_sales_by_apps_1_3"),
                    [15, 5, -10, 5, 16, 22, 6, -6, -12, 5],
                    KTApp.getStateColor("success"),
                    2
                ),
                t(
                    $("#kt_chart_sales_by_apps_1_4"),
                    [8, 18, -12, 12, 22, -2, -14, 16, 18, 2],
                    KTApp.getStateColor("warning"),
                    2
                ),
                t(
                    $("#kt_chart_sales_by_apps_2_1"),
                    [10, 20, -5, 8, -20, -2, -4, 15, 5, 8],
                    KTApp.getStateColor("danger"),
                    2
                ),
                t(
                    $("#kt_chart_sales_by_apps_2_2"),
                    [2, 16, 0, 12, 22, 5, -10, 5, 15, 2],
                    KTApp.getStateColor("dark"),
                    2
                ),
                t(
                    $("#kt_chart_sales_by_apps_2_3"),
                    [15, 5, -10, 5, 16, 22, 6, -6, -12, 5],
                    KTApp.getStateColor("brand"),
                    2
                ),
                t(
                    $("#kt_chart_sales_by_apps_2_4"),
                    [8, 18, -12, 12, 22, -2, -14, 16, 18, 2],
                    KTApp.getStateColor("info"),
                    2
                ),
                (function() {
                    if (0 != $("#kt_chart_latest_updates").length) {
                        var t = document
                                .getElementById("kt_chart_latest_updates")
                                .getContext("2d"),
                            e = {
                                type: "line",
                                data: {
                                    labels: [
                                        "January",
                                        "February",
                                        "March",
                                        "April",
                                        "May",
                                        "June",
                                        "July",
                                        "August",
                                        "September",
                                        "October"
                                    ],
                                    datasets: [
                                        {
                                            label: "Sales Stats",
                                            backgroundColor: KTApp.getStateColor(
                                                "danger"
                                            ),
                                            borderColor: KTApp.getStateColor(
                                                "danger"
                                            ),
                                            pointBackgroundColor: Chart.helpers
                                                .color("#000000")
                                                .alpha(0)
                                                .rgbString(),
                                            pointBorderColor: Chart.helpers
                                                .color("#000000")
                                                .alpha(0)
                                                .rgbString(),
                                            pointHoverBackgroundColor: KTApp.getStateColor(
                                                "success"
                                            ),
                                            pointHoverBorderColor: Chart.helpers
                                                .color("#000000")
                                                .alpha(0.1)
                                                .rgbString(),
                                            data: [
                                                10,
                                                14,
                                                12,
                                                16,
                                                9,
                                                11,
                                                13,
                                                9,
                                                13,
                                                15
                                            ]
                                        }
                                    ]
                                },
                                options: {
                                    title: { display: !1 },
                                    tooltips: {
                                        intersect: !1,
                                        mode: "nearest",
                                        xPadding: 10,
                                        yPadding: 10,
                                        caretPadding: 10
                                    },
                                    legend: { display: !1 },
                                    responsive: !0,
                                    maintainAspectRatio: !1,
                                    hover: { mode: "index" },
                                    scales: {
                                        xAxes: [
                                            {
                                                display: !1,
                                                gridLines: !1,
                                                scaleLabel: {
                                                    display: !0,
                                                    labelString: "Month"
                                                }
                                            }
                                        ],
                                        yAxes: [
                                            {
                                                display: !1,
                                                gridLines: !1,
                                                scaleLabel: {
                                                    display: !0,
                                                    labelString: "Value"
                                                },
                                                ticks: { beginAtZero: !0 }
                                            }
                                        ]
                                    },
                                    elements: {
                                        line: { tension: 1e-7 },
                                        point: { radius: 4, borderWidth: 12 }
                                    }
                                }
                            };
                        new Chart(t, e);
                    }
                })(),
                (function() {
                    if (0 != $("#kt_chart_trends_stats").length) {
                        var t = document
                                .getElementById("kt_chart_trends_stats")
                                .getContext("2d"),
                            e = t.createLinearGradient(0, 0, 0, 240);
                        e.addColorStop(
                            0,
                            Chart.helpers
                                .color("#00c5dc")
                                .alpha(0.7)
                                .rgbString()
                        ),
                            e.addColorStop(
                                1,
                                Chart.helpers
                                    .color("#f2feff")
                                    .alpha(0)
                                    .rgbString()
                            );
                        var a = {
                            type: "line",
                            data: {
                                labels: [
                                    "January",
                                    "February",
                                    "March",
                                    "April",
                                    "May",
                                    "June",
                                    "July",
                                    "August",
                                    "September",
                                    "October",
                                    "January",
                                    "February",
                                    "March",
                                    "April",
                                    "May",
                                    "June",
                                    "July",
                                    "August",
                                    "September",
                                    "October",
                                    "January",
                                    "February",
                                    "March",
                                    "April",
                                    "May",
                                    "June",
                                    "July",
                                    "August",
                                    "September",
                                    "October",
                                    "January",
                                    "February",
                                    "March",
                                    "April"
                                ],
                                datasets: [
                                    {
                                        label: "Sales Stats",
                                        backgroundColor: e,
                                        borderColor: "#0dc8de",
                                        pointBackgroundColor: Chart.helpers
                                            .color("#ffffff")
                                            .alpha(0)
                                            .rgbString(),
                                        pointBorderColor: Chart.helpers
                                            .color("#ffffff")
                                            .alpha(0)
                                            .rgbString(),
                                        pointHoverBackgroundColor: KTApp.getStateColor(
                                            "danger"
                                        ),
                                        pointHoverBorderColor: Chart.helpers
                                            .color("#000000")
                                            .alpha(0.2)
                                            .rgbString(),
                                        data: [
                                            20,
                                            10,
                                            18,
                                            15,
                                            26,
                                            18,
                                            15,
                                            22,
                                            16,
                                            12,
                                            12,
                                            13,
                                            10,
                                            18,
                                            14,
                                            24,
                                            16,
                                            12,
                                            19,
                                            21,
                                            16,
                                            14,
                                            21,
                                            21,
                                            13,
                                            15,
                                            22,
                                            24,
                                            21,
                                            11,
                                            14,
                                            19,
                                            21,
                                            17
                                        ]
                                    }
                                ]
                            },
                            options: {
                                title: { display: !1 },
                                tooltips: {
                                    intersect: !1,
                                    mode: "nearest",
                                    xPadding: 10,
                                    yPadding: 10,
                                    caretPadding: 10
                                },
                                legend: { display: !1 },
                                responsive: !0,
                                maintainAspectRatio: !1,
                                hover: { mode: "index" },
                                scales: {
                                    xAxes: [
                                        {
                                            display: !1,
                                            gridLines: !1,
                                            scaleLabel: {
                                                display: !0,
                                                labelString: "Month"
                                            }
                                        }
                                    ],
                                    yAxes: [
                                        {
                                            display: !1,
                                            gridLines: !1,
                                            scaleLabel: {
                                                display: !0,
                                                labelString: "Value"
                                            },
                                            ticks: { beginAtZero: !0 }
                                        }
                                    ]
                                },
                                elements: {
                                    line: { tension: 0.19 },
                                    point: { radius: 4, borderWidth: 12 }
                                },
                                layout: {
                                    padding: {
                                        left: 0,
                                        right: 0,
                                        top: 5,
                                        bottom: 0
                                    }
                                }
                            }
                        };
                        new Chart(t, a);
                    }
                })(),
                (function() {
                    if (0 != $("#kt_chart_trends_stats_2").length) {
                        var t = document
                                .getElementById("kt_chart_trends_stats_2")
                                .getContext("2d"),
                            e = {
                                type: "line",
                                data: {
                                    labels: [
                                        "January",
                                        "February",
                                        "March",
                                        "April",
                                        "May",
                                        "June",
                                        "July",
                                        "August",
                                        "September",
                                        "October",
                                        "January",
                                        "February",
                                        "March",
                                        "April",
                                        "May",
                                        "June",
                                        "July",
                                        "August",
                                        "September",
                                        "October",
                                        "January",
                                        "February",
                                        "March",
                                        "April",
                                        "May",
                                        "June",
                                        "July",
                                        "August",
                                        "September",
                                        "October",
                                        "January",
                                        "February",
                                        "March",
                                        "April"
                                    ],
                                    datasets: [
                                        {
                                            label: "Sales Stats",
                                            backgroundColor: "#d2f5f9",
                                            borderColor: KTApp.getStateColor(
                                                "brand"
                                            ),
                                            pointBackgroundColor: Chart.helpers
                                                .color("#ffffff")
                                                .alpha(0)
                                                .rgbString(),
                                            pointBorderColor: Chart.helpers
                                                .color("#ffffff")
                                                .alpha(0)
                                                .rgbString(),
                                            pointHoverBackgroundColor: KTApp.getStateColor(
                                                "danger"
                                            ),
                                            pointHoverBorderColor: Chart.helpers
                                                .color("#000000")
                                                .alpha(0.2)
                                                .rgbString(),
                                            data: [
                                                20,
                                                10,
                                                18,
                                                15,
                                                32,
                                                18,
                                                15,
                                                22,
                                                8,
                                                6,
                                                12,
                                                13,
                                                10,
                                                18,
                                                14,
                                                24,
                                                16,
                                                12,
                                                19,
                                                21,
                                                16,
                                                14,
                                                24,
                                                21,
                                                13,
                                                15,
                                                27,
                                                29,
                                                21,
                                                11,
                                                14,
                                                19,
                                                21,
                                                17
                                            ]
                                        }
                                    ]
                                },
                                options: {
                                    title: { display: !1 },
                                    tooltips: {
                                        intersect: !1,
                                        mode: "nearest",
                                        xPadding: 10,
                                        yPadding: 10,
                                        caretPadding: 10
                                    },
                                    legend: { display: !1 },
                                    responsive: !0,
                                    maintainAspectRatio: !1,
                                    hover: { mode: "index" },
                                    scales: {
                                        xAxes: [
                                            {
                                                display: !1,
                                                gridLines: !1,
                                                scaleLabel: {
                                                    display: !0,
                                                    labelString: "Month"
                                                }
                                            }
                                        ],
                                        yAxes: [
                                            {
                                                display: !1,
                                                gridLines: !1,
                                                scaleLabel: {
                                                    display: !0,
                                                    labelString: "Value"
                                                },
                                                ticks: { beginAtZero: !0 }
                                            }
                                        ]
                                    },
                                    elements: {
                                        line: { tension: 0.19 },
                                        point: { radius: 4, borderWidth: 12 }
                                    },
                                    layout: {
                                        padding: {
                                            left: 0,
                                            right: 0,
                                            top: 5,
                                            bottom: 0
                                        }
                                    }
                                }
                            };
                        new Chart(t, e);
                    }
                })(),
                (function() {
                    if (0 != $("#kt_chart_latest_trends_map").length)
                        try {
                            new GMaps({
                                div: "#kt_chart_latest_trends_map",
                                lat: -12.043333,
                                lng: -77.028333
                            });
                        } catch (t) {
                            console.log(t);
                        }
                })(),
                0 != $("#company_vehicles_distance").length &&
                    Morris.Donut({
                        element: "company_vehicles_distance",
                        data: [
                            { label: "0-50", value: CompanyDistance_0_50 },
                            {
                                label: "50-100",
                                value: CompanyDistance_50_100
                            },
                            {
                                label: "100-200",
                                value: CompanyDistance_100_200
                            },
                            {
                                label: "200-500",
                                value: CompanyDistance_200_500
                            },
                            { label: "++500", value: CompanyDistance_500 }
                        ],
                        colors: [
                            KTApp.getStateColor("success"),
                            KTApp.getStateColor("warning"),
                            KTApp.getStateColor("danger"),
                            "#770073",
                            KTApp.getStateColor("dark")
                        ]
                    }),
                $(document).on("click", ".carousel", function() {
                    var t = $(this).attr("data-position");
                    t &&
                        (e.trigger("to.owl.carousel", t),
                        a.trigger("to.owl.carousel", t));
                });
        }
    };
})();
jQuery(document).ready(function() {
    KTDashboard.init();
});
