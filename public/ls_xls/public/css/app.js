$(function () {

    $.fn.btnLoading = function () {
        var isABtn = false;
        var tagName = this[0].tagName;
        if (tagName && (tagName.toLowerCase() == 'a' || tagName.toLowerCase() == 'button' )) {
            isABtn = true;
        }
        window.AppCurrClickBtnText = isABtn ? this.text() : this.val();
        this.attr("disabled", true).css("opacity", ".65");
        var tip = "Loading...";
        if (isABtn) {
            this.text(tip);
        } else {
            this.val(tip);
        }
    };

    $.fn.btnLoadOver = function () {
        var isABtn = false;
        var tagName = this[0].tagName;
        if (tagName && (tagName.toLowerCase() == 'a' || tagName.toLowerCase() == 'button' )) {
            isABtn = true;
        }

        this.attr("disabled", false).css("opacity", "1");
        var tip = window.AppCurrClickBtnText;
        if (isABtn) {
            this.text(tip);
        } else {
            this.val(tip);
        }
    };

    $.fn.btnDisable = function () {
        this.attr("disabled", true).css("opacity", ".65");
    };

    $.fn.trimVal = function () {
        var val = this.val() || '';
        return $.trim(val);
    };

    $.fn.doubleVal = function () {
        return parseFloat(this.val());
    };

    $.extend({
    	
        reloadTimeout: function (seconds) {
            setTimeout(function () {
                window.location.reload();
            }, seconds * 1000)
        },
    	
        reload: function () {
            window.location.href = window.location.href;
        },

        slideAutoTipNotRefresh: function ($this, flag, msg) {
            if (flag) {
                msg = msg || window.AppTip.actionOk;
            }

            this.slideTip($this, flag, msg, false);
        },

        slideAutoTip: function ($this, flag, msg) {
            if (flag) {
                msg = msg || window.AppTip.actionOk;
            }

            this.slideTip($this, flag, msg, flag);
        },

        slideErrorTip: function ($this, flag, msg, enableRefresh) {
            this.slideTip($this, false, msg, false);
        },

        slideDefErrorTip: function ($this) {
            var msg = window.AppTip.actionError;
            this.slideTip($this, false, msg, false);
        },

        slideOkTip: function ($this, flag, msg, enableRefresh) {
            this.slideTip($this, true, msg, true);
        },

        ajaxPager: function ($this, pager) {

            $this.empty();

            var ip_pageNum = pager.pageNum;

            var ip_pagesTotal = pager.pagesTotal;

            var ip_rowsPerPage = pager.rowsPerPage;

            if (ip_pageNum > 1) {
                $this.append("<li><a class='page-ajax-a' data-PageNum = '" + (ip_pageNum - 1) + "' data-RowsPerPage = '" + ip_rowsPerPage + "' ><</a></li>");
                if (ip_pageNum - 5 > 1) {
                    $this.append("<li><a class='page-ajax-a' data-PageNum = '" + (ip_pageNum - 1) + "' data-RowsPerPage = '" + ip_rowsPerPage + "' >1</a></li>");
                }
            }else{
                $this.append("<li class='disabled'><a ><</a></li>")
            }

            for(var i = -5 ; i<= 5 ; i++){

                if(i==0){

                    $this.append("<li class='active'><a class='page-ajax-a'>"+ip_pageNum+"</a></li>");

                }else if (ip_pageNum +i>0 && ip_pageNum +i<= ip_pagesTotal){

                    $this.append("<li><a class='page-ajax-a' data-PageNum = '" + (ip_pageNum + i) + "' data-RowsPerPage = '" + ip_rowsPerPage + "' >"+(ip_pageNum+i)+"</a></li>");

                }

            }

            if(ip_pagesTotal !=0 && ip_pageNum != ip_pagesTotal){

                if(ip_pageNum +5< ip_pagesTotal){

                    $this.append("<li><a class='page-ajax-a' data-PageNum = '" + ip_pagesTotal + "' data-RowsPerPage = '" + ip_rowsPerPage + "' >"+ip_pagesTotal+"</a></li>");

                }

                $this.append("<li><a class='page-ajax-a' data-PageNum = '" + (ip_pageNum+1) + "' data-RowsPerPage = '" + ip_rowsPerPage + "' >></a></li>");

            }else{

                $this.append("<li class='disabled'><a >></a></li>");

            }

        },

        blockForm: function ($form, btn1, btn2) {
            var btn1Text = btn1['text'];
            var btn1Url = btn1['url'];
            var btn2Text = btn2['text'];
            var btn2Url = btn2['url'];

            var message = '<a type="button" class="btn btn-success" href="' + btn1Url + '">' + btn1Text + '</a>';
            if(true){
                message+='<a type="button" class="btn btn-info" href="'+btn2Url+'" style="margin-left: 30px">'+btn2Text+'</a>'
            }

            $form.find("div.panel-body").block({
                message: message,
                overlayCSS: {
                    backgroundColor: '#21211D',
                    opacity: 0.8,
                    cursor: 'pointer'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none'
                }
            });
        },

        slideTip: function ($this, flag, msg, enableRefresh) {
            if (enableRefresh) {
                msg += "，" + window.AppTip.refreshPageSuffix + "！";
            }

            var $actionTipBox = $this.parents("form").find("#actionTipBox");
            $actionTipBox.removeClass("alert-success").removeClass("alert-danger").addClass(flag ? "alert-success" : "alert-danger");

            var $tipContent = $actionTipBox.find(".tipContent");
            $tipContent.html(msg);

            $actionTipBox.show();

            //若操作成功且开启自动刷新
            if (flag && enableRefresh) {
                var that = this;
                setTimeout(function () {
                    that.reload();
                }, 5000);
            }

            //若出错则提示信息定时收起
            if (!flag) {
                setTimeout(function () {
                    $actionTipBox.slideUp();
                }, window.AppTip.timoutSeconds * 1000);
            }

            if(flag){
                showOk(msg);
            }else{
                showError(msg);
            }
        },

        ajaxJson: function (url, data, cb) {
            data = data || {};
            cb = cb || {};
            return $.ajax({
                url: url,
                method: "GET",
                data: data,
                dataType: "json",
                success: cb['yes'] || function () {
                },
                error: cb['no'] || function () {
                },
                beforeSend: cb['before'] || function () {
                },
                complete: cb['over'] || function () {
                }
            });
        },

        ajaxPostJson: function (url, data, cb) {
            data = data || {};
            cb = cb || {};
            return $.ajax({
                url: url,
                method: "POST",
                data: data,
                dataType: "json",
                success: cb['yes'] || function () {
                },
                error: cb['no'] || function () {
                },
                beforeSend: cb['before'] || function () {
                },
                complete: cb['over'] || function () {
                }
            });
        }
    });

    $.fn.nano = function (url, data, cb) {
        return template.replace(/\{([\w\.]*)\}/g, function (str, key) {
            var keys = key.split("."), v = data[keys.shift()];
            for (var i = 0, l = keys.length; i < l; i++) v = v[keys[i]];
            return (typeof v !== "undefined" && v !== null) ? v : "";
        });
    }

    $(".form-clear-btn").click(function () {
        var $from = $("form.form-clear-enable");
        $from.find("input[type='text']").val('');
        $from.find("input[type='password']").val('');
    });


});

var AppMain = {
    isMobileValid: function (mobile) {
        return mobile && /^[0-9]{11}$/.test(mobile);
    },
    isPasswordValid: function (psw) {
        return psw && /^(?![^a-zA-Z]+$)(?!\D+$).{6,20}$/.test(psw);
    },
    isPassportNameValid: function (PassportName) {
        return PassportName && /^(?![^a-zA-Z]+$)(?!\D+$).{3,20}$/.test(PassportName);
    },
    isBeginDateGtEndDate: function (startDateVal, endDateVal) {
        if (startDateVal.indexOf("-") != -1 && endDateVal.indexOf("-") != -1) {
            var begin = new Date(startDateVal.replace(/-/g, "/"));
            var end = new Date(endDateVal.replace(/-/g, "/"));

            if (begin - end > 0) {
                return true;
            }
            return false;
        }
    }
};