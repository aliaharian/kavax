function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(input).prev().find('img').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(document).ready(function () {
    $('#uid').next().next().addClass('filterfield');
    $('#uid').next().click(function () {
        $('#filterfield').focus();
    });
});

function FilterFunction() {
    var input, filter, list, item, a, i, txtValue;
    input = document.getElementById("filterfield");
    filter = input.value.toUpperCase();
    list = input.parentElement.nextElementSibling.getElementsByClassName('select-items')[0];
    item = list.getElementsByTagName("div");
    for (i = 0; i < item.length; i++) {
        a = item[i];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            item[i].style.display = "";
        } else {
            item[i].style.display = "none";
        }
    }
}

$(document).ready(function () {
    var to, from;
    from = $('#expire_date').persianDatepicker({
        "observer": true,
        "initialValueType": 'persian',
        "altField": '#expire-date-reseller',
        "altFormat": 'unix',
        "inline": false,
        "format": "YYYY/MM/DD",
        "viewMode": "day",
        "initialValue": false,
        "onSelect": function (unix) {
            from.touched = true;
            if (to && to.options && to.options.minDate != unix) {
                var cachedValue = to.getState().selected.unixDate;
                to.options = {minDate: unix};
                if (to.touched) {
                    to.setDate(cachedValue);
                }
            }

            var timestamp = unix / 1000; // replace your timestamp
            $("#expire-date-reseller").val(timestamp);
        },
        "minDate": '<?php time() ?>0000',
        "maxDate": null,
        "autoClose": false,
        "position": "auto",
        "onlyTimePicker": false,
        "onlySelectOnDate": false,
        "calendarType": "persian",
        "inputDelay": "0",
        "calendar": {
            "persian": {
                "locale": "fa",
                "showHint": true,
                "leapYearMode": "algorithmic"
            },
            "gregorian": {
                "locale": "en",
                "showHint": false
            }
        },
        "navigator": {
            "enabled": true,
            "scroll": {
                "enabled": false
            },
            "text": {
                "btnNextText": "",
                "btnPrevText": ""
            }
        },
        "toolbox": {
            "enabled": true,
            "calendarSwitch": {
                "enabled": false,
                "format": "MMMM"
            },
            "todayButton": {
                "enabled": true,
                "text": {
                    "fa": "امروز",
                    "en": "Today"
                }
            },
            "submitButton": {
                "enabled": true,
                "text": {
                    "fa": "تایید",
                    "en": "Submit"
                }
            },
            "text": {
                "btnToday": "امروز"
            }
        },
        "dayPicker": {
            "enabled": true,
            "titleFormat": "YYYY MMMM"
        },
        "monthPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "yearPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "responsive": true
    });
    to = $('.date-picker-filter.date-to').persianDatepicker({
        "inline": false,
        "format": "dddd YYYY/MM/DD ساعت: H:mm",
        "altFormat": 'unix',
        "observer": true,
        "initialValueType": 'persian',
        "altField": '#date-to',
        "viewMode": "day",
        "initialValue": false,
        "onSelect": function (unix) {
            to.touched = true;
            if (from && from.options && from.options.maxDate != unix) {
                var cachedValue = from.getState().selected.unixDate;
                from.options = {maxDate: unix};
                if (from.touched) {
                    from.setDate(cachedValue);
                }
            }
        },
        "minDate": '<?php time() ?>0000',
        "maxDate": null,
        "autoClose": false,
        "position": "auto",
        "onlyTimePicker": false,
        "onlySelectOnDate": false,
        "calendarType": "persian",
        "inputDelay": "0",
        "calendar": {
            "persian": {
                "locale": "fa",
                "showHint": true,
                "leapYearMode": "algorithmic"
            },
            "gregorian": {
                "locale": "en",
                "showHint": false
            }
        },
        "navigator": {
            "enabled": true,
            "scroll": {
                "enabled": false
            },
            "text": {
                "btnNextText": "",
                "btnPrevText": ""
            }
        },
        "toolbox": {
            "enabled": true,
            "calendarSwitch": {
                "enabled": false,
                "format": "MMMM"
            },
            "todayButton": {
                "enabled": true,
                "text": {
                    "fa": "امروز",
                    "en": "Today"
                }
            },
            "submitButton": {
                "enabled": true,
                "text": {
                    "fa": "تایید",
                    "en": "Submit"
                }
            },
            "text": {
                "btnToday": "امروز"
            }
        },
        "timePicker": {
            "enabled": false,
            "step": 1,
            "hour": {
                "enabled": true,
                "step": null
            },
            "minute": {
                "enabled": true,
                "step": null
            },
            "second": {
                "enabled": true,
                "step": null
            },
            "meridian": {
                "enabled": true
            }
        },
        "dayPicker": {
            "enabled": true,
            "titleFormat": "YYYY MMMM"
        },
        "monthPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "yearPicker": {
            "enabled": true,
            "titleFormat": "YYYY"
        },
        "timePicker": {
            "enabled": true,
            "step": 1,
            "hour": {
                "enabled": true,
                "step": null
            },
            "minute": {
                "enabled": true,
                "step": null
            },
            "second": {
                "enabled": true,
                "step": null
            },
            "meridian": {
                "enabled": true
            }
        },
        "responsive": true
    });
});
