! function(t) {
    "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
}(function(t) {
    function e(e, s) {
        var n, o, a, r = e.nodeName.toLowerCase();
        return "area" === r ? (n = e.parentNode, o = n.name, e.href && o && "map" === n.nodeName.toLowerCase() ? (a = t("img[usemap=#" + o + "]")[0], !!a && i(a)) : !1) : (/input|select|textarea|button|object/.test(r) ? !e.disabled : "a" === r ? e.href || s : s) && i(e)
    }

    function i(e) {
        return t.expr.filters.visible(e) && !t(e).parents().addBack().filter(function() {
            return "hidden" === t.css(this, "visibility")
        }).length
    }

    function s(t) {
        for (var e, i; t.length && t[0] !== document;) {
            if (e = t.css("position"), ("absolute" === e || "relative" === e || "fixed" === e) && (i = parseInt(t.css("zIndex"), 10), !isNaN(i) && 0 !== i)) return i;
            t = t.parent()
        }
        return 0
    }

    function n() {
        this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
            closeText: "Done",
            prevText: "Prev",
            nextText: "Next",
            currentText: "Today",
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            weekHeader: "Wk",
            dateFormat: "mm/dd/yy",
            firstDay: 0,
            isRTL: !1,
            showMonthAfterYear: !1,
            yearSuffix: ""
        }, this._defaults = {
            showOn: "focus",
            showAnim: "fadeIn",
            showOptions: {},
            defaultDate: null,
            appendText: "",
            buttonText: "...",
            buttonImage: "",
            buttonImageOnly: !1,
            hideIfNoPrevNext: !1,
            navigationAsDateFormat: !1,
            gotoCurrent: !1,
            changeMonth: !1,
            changeYear: !1,
            yearRange: "c-10:c+10",
            showOtherMonths: !1,
            selectOtherMonths: !1,
            showWeek: !1,
            calculateWeek: this.iso8601Week,
            shortYearCutoff: "+10",
            minDate: null,
            maxDate: null,
            duration: "fast",
            beforeShowDay: null,
            beforeShow: null,
            onSelect: null,
            onChangeMonthYear: null,
            onClose: null,
            numberOfMonths: 1,
            showCurrentAtPos: 0,
            stepMonths: 1,
            stepBigMonths: 12,
            altField: "",
            altFormat: "",
            constrainInput: !0,
            showButtonPanel: !1,
            autoSize: !1,
            disabled: !1
        }, t.extend(this._defaults, this.regional[""]), this.regional.en = t.extend(!0, {}, this.regional[""]), this.regional["en-US"] = t.extend(!0, {}, this.regional.en), this.dpDiv = o(t("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))
    }

    function o(e) {
        var i = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
        return e.delegate(i, "mouseout", function() {
            t(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).removeClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).removeClass("ui-datepicker-next-hover")
        }).delegate(i, "mouseover", function() {
            t.datepicker._isDisabledDatepicker(g.inline ? e.parent()[0] : g.input[0]) || (t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), t(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).addClass("ui-datepicker-next-hover"))
        })
    }

    function a(e, i) {
        t.extend(e, i);
        for (var s in i) null == i[s] && (e[s] = i[s]);
        return e
    }

    function r(t) {
        return function() {
            var e = this.element.val();
            t.apply(this, arguments), this._refresh(), e !== this.element.val() && this._trigger("change")
        }
    }
    t.ui = t.ui || {}, t.extend(t.ui, {
        version: "1.11.0",
        keyCode: {
            BACKSPACE: 8,
            COMMA: 188,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            LEFT: 37,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SPACE: 32,
            TAB: 9,
            UP: 38
        }
    }), t.fn.extend({
        scrollParent: function() {
            var e = this.css("position"),
                i = "absolute" === e,
                s = this.parents().filter(function() {
                    var e = t(this);
                    return i && "static" === e.css("position") ? !1 : /(auto|scroll)/.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"))
                }).eq(0);
            return "fixed" !== e && s.length ? s : t(this[0].ownerDocument || document)
        },
        uniqueId: function() {
            var t = 0;
            return function() {
                return this.each(function() {
                    this.id || (this.id = "ui-id-" + ++t)
                })
            }
        }(),
        removeUniqueId: function() {
            return this.each(function() {
                /^ui-id-\d+$/.test(this.id) && t(this).removeAttr("id")
            })
        }
    }), t.extend(t.expr[":"], {
        data: t.expr.createPseudo ? t.expr.createPseudo(function(e) {
            return function(i) {
                return !!t.data(i, e)
            }
        }) : function(e, i, s) {
            return !!t.data(e, s[3])
        },
        focusable: function(i) {
            return e(i, !isNaN(t.attr(i, "tabindex")))
        },
        tabbable: function(i) {
            var s = t.attr(i, "tabindex"),
                n = isNaN(s);
            return (n || s >= 0) && e(i, !n)
        }
    }), t("<a>").outerWidth(1).jquery || t.each(["Width", "Height"], function(e, i) {
        function s(e, i, s, o) {
            return t.each(n, function() {
                i -= parseFloat(t.css(e, "padding" + this)) || 0, s && (i -= parseFloat(t.css(e, "border" + this + "Width")) || 0), o && (i -= parseFloat(t.css(e, "margin" + this)) || 0)
            }), i
        }
        var n = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
            o = i.toLowerCase(),
            a = {
                innerWidth: t.fn.innerWidth,
                innerHeight: t.fn.innerHeight,
                outerWidth: t.fn.outerWidth,
                outerHeight: t.fn.outerHeight
            };
        t.fn["inner" + i] = function(e) {
            return void 0 === e ? a["inner" + i].call(this) : this.each(function() {
                t(this).css(o, s(this, e) + "px")
            })
        }, t.fn["outer" + i] = function(e, n) {
            return "number" != typeof e ? a["outer" + i].call(this, e) : this.each(function() {
                t(this).css(o, s(this, e, !0, n) + "px")
            })
        }
    }), t.fn.addBack || (t.fn.addBack = function(t) {
        return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
    }), t("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (t.fn.removeData = function(e) {
        return function(i) {
            return arguments.length ? e.call(this, t.camelCase(i)) : e.call(this)
        }
    }(t.fn.removeData)), t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), t.fn.extend({
        focus: function(e) {
            return function(i, s) {
                return "number" == typeof i ? this.each(function() {
                    var e = this;
                    setTimeout(function() {
                        t(e).focus(), s && s.call(e)
                    }, i)
                }) : e.apply(this, arguments)
            }
        }(t.fn.focus),
        disableSelection: function() {
            var t = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
            return function() {
                return this.bind(t + ".ui-disableSelection", function(t) {
                    t.preventDefault()
                })
            }
        }(),
        enableSelection: function() {
            return this.unbind(".ui-disableSelection")
        },
        zIndex: function(e) {
            if (void 0 !== e) return this.css("zIndex", e);
            if (this.length)
                for (var i, s, n = t(this[0]); n.length && n[0] !== document;) {
                    if (i = n.css("position"), ("absolute" === i || "relative" === i || "fixed" === i) && (s = parseInt(n.css("zIndex"), 10), !isNaN(s) && 0 !== s)) return s;
                    n = n.parent()
                }
            return 0
        }
    }), t.ui.plugin = {
        add: function(e, i, s) {
            var n, o = t.ui[e].prototype;
            for (n in s) o.plugins[n] = o.plugins[n] || [], o.plugins[n].push([i, s[n]])
        },
        call: function(t, e, i, s) {
            var n, o = t.plugins[e];
            if (o && (s || t.element[0].parentNode && 11 !== t.element[0].parentNode.nodeType))
                for (n = 0; n < o.length; n++) t.options[o[n][0]] && o[n][1].apply(t.element, i)
        }
    };
    var h = 0,
        l = Array.prototype.slice;
    t.cleanData = function(e) {
        return function(i) {
            for (var s, n = 0; null != (s = i[n]); n++) try {
                t(s).triggerHandler("remove")
            } catch (o) {}
            e(i)
        }
    }(t.cleanData), t.widget = function(e, i, s) {
        var n, o, a, r, h = {},
            l = e.split(".")[0];
        return e = e.split(".")[1], n = l + "-" + e, s || (s = i, i = t.Widget), t.expr[":"][n.toLowerCase()] = function(e) {
            return !!t.data(e, n)
        }, t[l] = t[l] || {}, o = t[l][e], a = t[l][e] = function(t, e) {
            return this._createWidget ? void(arguments.length && this._createWidget(t, e)) : new a(t, e)
        }, t.extend(a, o, {
            version: s.version,
            _proto: t.extend({}, s),
            _childConstructors: []
        }), r = new i, r.options = t.widget.extend({}, r.options), t.each(s, function(e, s) {
            return t.isFunction(s) ? void(h[e] = function() {
                var t = function() {
                        return i.prototype[e].apply(this, arguments)
                    },
                    n = function(t) {
                        return i.prototype[e].apply(this, t)
                    };
                return function() {
                    var e, i = this._super,
                        o = this._superApply;
                    return this._super = t, this._superApply = n, e = s.apply(this, arguments), this._super = i, this._superApply = o, e
                }
            }()) : void(h[e] = s)
        }), a.prototype = t.widget.extend(r, {
            widgetEventPrefix: o ? r.widgetEventPrefix || e : e
        }, h, {
            constructor: a,
            namespace: l,
            widgetName: e,
            widgetFullName: n
        }), o ? (t.each(o._childConstructors, function(e, i) {
            var s = i.prototype;
            t.widget(s.namespace + "." + s.widgetName, a, i._proto)
        }), delete o._childConstructors) : i._childConstructors.push(a), t.widget.bridge(e, a), a
    }, t.widget.extend = function(e) {
        for (var i, s, n = l.call(arguments, 1), o = 0, a = n.length; a > o; o++)
            for (i in n[o]) s = n[o][i], n[o].hasOwnProperty(i) && void 0 !== s && (t.isPlainObject(s) ? e[i] = t.isPlainObject(e[i]) ? t.widget.extend({}, e[i], s) : t.widget.extend({}, s) : e[i] = s);
        return e
    }, t.widget.bridge = function(e, i) {
        var s = i.prototype.widgetFullName || e;
        t.fn[e] = function(n) {
            var o = "string" == typeof n,
                a = l.call(arguments, 1),
                r = this;
            return n = !o && a.length ? t.widget.extend.apply(null, [n].concat(a)) : n, o ? this.each(function() {
                var i, o = t.data(this, s);
                return "instance" === n ? (r = o, !1) : o ? t.isFunction(o[n]) && "_" !== n.charAt(0) ? (i = o[n].apply(o, a), i !== o && void 0 !== i ? (r = i && i.jquery ? r.pushStack(i.get()) : i, !1) : void 0) : t.error("no such method '" + n + "' for " + e + " widget instance") : t.error("cannot call methods on " + e + " prior to initialization; attempted to call method '" + n + "'")
            }) : this.each(function() {
                var e = t.data(this, s);
                e ? (e.option(n || {}), e._init && e._init()) : t.data(this, s, new i(n, this))
            }), r
        }
    }, t.Widget = function() {}, t.Widget._childConstructors = [], t.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {
            disabled: !1,
            create: null
        },
        _createWidget: function(e, i) {
            i = t(i || this.defaultElement || this)[0], this.element = t(i), this.uuid = h++, this.eventNamespace = "." + this.widgetName + this.uuid, this.options = t.widget.extend({}, this.options, this._getCreateOptions(), e), this.bindings = t(), this.hoverable = t(), this.focusable = t(), i !== this && (t.data(i, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function(t) {
                    t.target === i && this.destroy()
                }
            }), this.document = t(i.style ? i.ownerDocument : i.document || i), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init()
        },
        _getCreateOptions: t.noop,
        _getCreateEventData: t.noop,
        _create: t.noop,
        _init: t.noop,
        destroy: function() {
            this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(t.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")
        },
        _destroy: t.noop,
        widget: function() {
            return this.element
        },
        option: function(e, i) {
            var s, n, o, a = e;
            if (0 === arguments.length) return t.widget.extend({}, this.options);
            if ("string" == typeof e)
                if (a = {}, s = e.split("."), e = s.shift(), s.length) {
                    for (n = a[e] = t.widget.extend({}, this.options[e]), o = 0; o < s.length - 1; o++) n[s[o]] = n[s[o]] || {}, n = n[s[o]];
                    if (e = s.pop(), 1 === arguments.length) return void 0 === n[e] ? null : n[e];
                    n[e] = i
                } else {
                    if (1 === arguments.length) return void 0 === this.options[e] ? null : this.options[e];
                    a[e] = i
                }
            return this._setOptions(a), this
        },
        _setOptions: function(t) {
            var e;
            for (e in t) this._setOption(e, t[e]);
            return this
        },
        _setOption: function(t, e) {
            return this.options[t] = e, "disabled" === t && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!e), e && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), this
        },
        enable: function() {
            return this._setOptions({
                disabled: !1
            })
        },
        disable: function() {
            return this._setOptions({
                disabled: !0
            })
        },
        _on: function(e, i, s) {
            var n, o = this;
            "boolean" != typeof e && (s = i, i = e, e = !1), s ? (i = n = t(i), this.bindings = this.bindings.add(i)) : (s = i, i = this.element, n = this.widget()), t.each(s, function(s, a) {
                function r() {
                    return e || o.options.disabled !== !0 && !t(this).hasClass("ui-state-disabled") ? ("string" == typeof a ? o[a] : a).apply(o, arguments) : void 0
                }
                "string" != typeof a && (r.guid = a.guid = a.guid || r.guid || t.guid++);
                var h = s.match(/^([\w:-]*)\s*(.*)$/),
                    l = h[1] + o.eventNamespace,
                    c = h[2];
                c ? n.delegate(c, l, r) : i.bind(l, r)
            })
        },
        _off: function(t, e) {
            e = (e || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, t.unbind(e).undelegate(e)
        },
        _delay: function(t, e) {
            function i() {
                return ("string" == typeof t ? s[t] : t).apply(s, arguments)
            }
            var s = this;
            return setTimeout(i, e || 0)
        },
        _hoverable: function(e) {
            this.hoverable = this.hoverable.add(e), this._on(e, {
                mouseenter: function(e) {
                    t(e.currentTarget).addClass("ui-state-hover")
                },
                mouseleave: function(e) {
                    t(e.currentTarget).removeClass("ui-state-hover")
                }
            })
        },
        _focusable: function(e) {
            this.focusable = this.focusable.add(e), this._on(e, {
                focusin: function(e) {
                    t(e.currentTarget).addClass("ui-state-focus")
                },
                focusout: function(e) {
                    t(e.currentTarget).removeClass("ui-state-focus")
                }
            })
        },
        _trigger: function(e, i, s) {
            var n, o, a = this.options[e];
            if (s = s || {}, i = t.Event(i), i.type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), i.target = this.element[0], o = i.originalEvent)
                for (n in o) n in i || (i[n] = o[n]);
            return this.element.trigger(i, s), !(t.isFunction(a) && a.apply(this.element[0], [i].concat(s)) === !1 || i.isDefaultPrevented())
        }
    }, t.each({
        show: "fadeIn",
        hide: "fadeOut"
    }, function(e, i) {
        t.Widget.prototype["_" + e] = function(s, n, o) {
            "string" == typeof n && (n = {
                effect: n
            });
            var a, r = n ? n === !0 || "number" == typeof n ? i : n.effect || i : e;
            n = n || {}, "number" == typeof n && (n = {
                duration: n
            }), a = !t.isEmptyObject(n), n.complete = o, n.delay && s.delay(n.delay), a && t.effects && t.effects.effect[r] ? s[e](n) : r !== e && s[r] ? s[r](n.duration, n.easing, o) : s.queue(function(i) {
                t(this)[e](), o && o.call(s[0]), i()
            })
        }
    });
    var c = (t.widget, !1);
    t(document).mouseup(function() {
        c = !1
    });
    t.widget("ui.mouse", {
        version: "1.11.0",
        options: {
            cancel: "input,textarea,button,select,option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function() {
            var e = this;
            this.element.bind("mousedown." + this.widgetName, function(t) {
                return e._mouseDown(t)
            }).bind("click." + this.widgetName, function(i) {
                return !0 === t.data(i.target, e.widgetName + ".preventClickEvent") ? (t.removeData(i.target, e.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1) : void 0
            }), this.started = !1
        },
        _mouseDestroy: function() {
            this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
        },
        _mouseDown: function(e) {
            if (!c) {
                this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
                var i = this,
                    s = 1 === e.which,
                    n = "string" == typeof this.options.cancel && e.target.nodeName ? t(e.target).closest(this.options.cancel).length : !1;
                return s && !n && this._mouseCapture(e) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                    i.mouseDelayMet = !0
                }, this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(e) !== !1, !this._mouseStarted) ? (e.preventDefault(), !0) : (!0 === t.data(e.target, this.widgetName + ".preventClickEvent") && t.removeData(e.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(t) {
                    return i._mouseMove(t)
                }, this._mouseUpDelegate = function(t) {
                    return i._mouseUp(t)
                }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), e.preventDefault(), c = !0, !0)) : !0
            }
        },
        _mouseMove: function(e) {
            return t.ui.ie && (!document.documentMode || document.documentMode < 9) && !e.button ? this._mouseUp(e) : e.which ? this._mouseStarted ? (this._mouseDrag(e), e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, e) !== !1, this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted) : this._mouseUp(e)
        },
        _mouseUp: function(e) {
            return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)), c = !1, !1
        },
        _mouseDistanceMet: function(t) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance
        },
        _mouseDelayMet: function() {
            return this.mouseDelayMet
        },
        _mouseStart: function() {},
        _mouseDrag: function() {},
        _mouseStop: function() {},
        _mouseCapture: function() {
            return !0
        }
    });
    ! function() {
        function e(t, e, i) {
            return [parseFloat(t[0]) * (p.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (p.test(t[1]) ? i / 100 : 1)]
        }

        function i(e, i) {
            return parseInt(t.css(e, i), 10) || 0
        }

        function s(e) {
            var i = e[0];
            return 9 === i.nodeType ? {
                width: e.width(),
                height: e.height(),
                offset: {
                    top: 0,
                    left: 0
                }
            } : t.isWindow(i) ? {
                width: e.width(),
                height: e.height(),
                offset: {
                    top: e.scrollTop(),
                    left: e.scrollLeft()
                }
            } : i.preventDefault ? {
                width: 0,
                height: 0,
                offset: {
                    top: i.pageY,
                    left: i.pageX
                }
            } : {
                width: e.outerWidth(),
                height: e.outerHeight(),
                offset: e.offset()
            }
        }
        t.ui = t.ui || {};
        var n, o, a = Math.max,
            r = Math.abs,
            h = Math.round,
            l = /left|center|right/,
            c = /top|center|bottom/,
            u = /[\+\-]\d+(\.[\d]+)?%?/,
            d = /^\w+/,
            p = /%$/,
            f = t.fn.position;
        t.position = {
                scrollbarWidth: function() {
                    if (void 0 !== n) return n;
                    var e, i, s = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                        o = s.children()[0];
                    return t("body").append(s), e = o.offsetWidth, s.css("overflow", "scroll"), i = o.offsetWidth, e === i && (i = s[0].clientWidth), s.remove(), n = e - i
                },
                getScrollInfo: function(e) {
                    var i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"),
                        s = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"),
                        n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth,
                        o = "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight;
                    return {
                        width: o ? t.position.scrollbarWidth() : 0,
                        height: n ? t.position.scrollbarWidth() : 0
                    }
                },
                getWithinInfo: function(e) {
                    var i = t(e || window),
                        s = t.isWindow(i[0]),
                        n = !!i[0] && 9 === i[0].nodeType;
                    return {
                        element: i,
                        isWindow: s,
                        isDocument: n,
                        offset: i.offset() || {
                            left: 0,
                            top: 0
                        },
                        scrollLeft: i.scrollLeft(),
                        scrollTop: i.scrollTop(),
                        width: s ? i.width() : i.outerWidth(),
                        height: s ? i.height() : i.outerHeight()
                    }
                }
            }, t.fn.position = function(n) {
                if (!n || !n.of) return f.apply(this, arguments);
                n = t.extend({}, n);
                var p, m, g, v, _, b, y = t(n.of),
                    w = t.position.getWithinInfo(n.within),
                    k = t.position.getScrollInfo(w),
                    x = (n.collision || "flip").split(" "),
                    D = {};
                return b = s(y), y[0].preventDefault && (n.at = "left top"), m = b.width, g = b.height, v = b.offset, _ = t.extend({}, v), t.each(["my", "at"], function() {
                    var t, e, i = (n[this] || "").split(" ");
                    1 === i.length && (i = l.test(i[0]) ? i.concat(["center"]) : c.test(i[0]) ? ["center"].concat(i) : ["center", "center"]), i[0] = l.test(i[0]) ? i[0] : "center", i[1] = c.test(i[1]) ? i[1] : "center", t = u.exec(i[0]), e = u.exec(i[1]), D[this] = [t ? t[0] : 0, e ? e[0] : 0], n[this] = [d.exec(i[0])[0], d.exec(i[1])[0]]
                }), 1 === x.length && (x[1] = x[0]), "right" === n.at[0] ? _.left += m : "center" === n.at[0] && (_.left += m / 2), "bottom" === n.at[1] ? _.top += g : "center" === n.at[1] && (_.top += g / 2), p = e(D.at, m, g), _.left += p[0], _.top += p[1], this.each(function() {
                    var s, l, c = t(this),
                        u = c.outerWidth(),
                        d = c.outerHeight(),
                        f = i(this, "marginLeft"),
                        b = i(this, "marginTop"),
                        C = u + f + i(this, "marginRight") + k.width,
                        I = d + b + i(this, "marginBottom") + k.height,
                        T = t.extend({}, _),
                        M = e(D.my, c.outerWidth(), c.outerHeight());
                    "right" === n.my[0] ? T.left -= u : "center" === n.my[0] && (T.left -= u / 2), "bottom" === n.my[1] ? T.top -= d : "center" === n.my[1] && (T.top -= d / 2), T.left += M[0], T.top += M[1], o || (T.left = h(T.left), T.top = h(T.top)), s = {
                        marginLeft: f,
                        marginTop: b
                    }, t.each(["left", "top"], function(e, i) {
                        t.ui.position[x[e]] && t.ui.position[x[e]][i](T, {
                            targetWidth: m,
                            targetHeight: g,
                            elemWidth: u,
                            elemHeight: d,
                            collisionPosition: s,
                            collisionWidth: C,
                            collisionHeight: I,
                            offset: [p[0] + M[0], p[1] + M[1]],
                            my: n.my,
                            at: n.at,
                            within: w,
                            elem: c
                        })
                    }), n.using && (l = function(t) {
                        var e = v.left - T.left,
                            i = e + m - u,
                            s = v.top - T.top,
                            o = s + g - d,
                            h = {
                                target: {
                                    element: y,
                                    left: v.left,
                                    top: v.top,
                                    width: m,
                                    height: g
                                },
                                element: {
                                    element: c,
                                    left: T.left,
                                    top: T.top,
                                    width: u,
                                    height: d
                                },
                                horizontal: 0 > i ? "left" : e > 0 ? "right" : "center",
                                vertical: 0 > o ? "top" : s > 0 ? "bottom" : "middle"
                            };
                        u > m && r(e + i) < m && (h.horizontal = "center"), d > g && r(s + o) < g && (h.vertical = "middle"), a(r(e), r(i)) > a(r(s), r(o)) ? h.important = "horizontal" : h.important = "vertical", n.using.call(this, t, h)
                    }), c.offset(t.extend(T, {
                        using: l
                    }))
                })
            }, t.ui.position = {
                fit: {
                    left: function(t, e) {
                        var i, s = e.within,
                            n = s.isWindow ? s.scrollLeft : s.offset.left,
                            o = s.width,
                            r = t.left - e.collisionPosition.marginLeft,
                            h = n - r,
                            l = r + e.collisionWidth - o - n;
                        e.collisionWidth > o ? h > 0 && 0 >= l ? (i = t.left + h + e.collisionWidth - o - n, t.left += h - i) : l > 0 && 0 >= h ? t.left = n : h > l ? t.left = n + o - e.collisionWidth : t.left = n : h > 0 ? t.left += h : l > 0 ? t.left -= l : t.left = a(t.left - r, t.left)
                    },
                    top: function(t, e) {
                        var i, s = e.within,
                            n = s.isWindow ? s.scrollTop : s.offset.top,
                            o = e.within.height,
                            r = t.top - e.collisionPosition.marginTop,
                            h = n - r,
                            l = r + e.collisionHeight - o - n;
                        e.collisionHeight > o ? h > 0 && 0 >= l ? (i = t.top + h + e.collisionHeight - o - n, t.top += h - i) : l > 0 && 0 >= h ? t.top = n : h > l ? t.top = n + o - e.collisionHeight : t.top = n : h > 0 ? t.top += h : l > 0 ? t.top -= l : t.top = a(t.top - r, t.top)
                    }
                },
                flip: {
                    left: function(t, e) {
                        var i, s, n = e.within,
                            o = n.offset.left + n.scrollLeft,
                            a = n.width,
                            h = n.isWindow ? n.scrollLeft : n.offset.left,
                            l = t.left - e.collisionPosition.marginLeft,
                            c = l - h,
                            u = l + e.collisionWidth - a - h,
                            d = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0,
                            p = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0,
                            f = -2 * e.offset[0];
                        0 > c ? (i = t.left + d + p + f + e.collisionWidth - a - o, (0 > i || i < r(c)) && (t.left += d + p + f)) : u > 0 && (s = t.left - e.collisionPosition.marginLeft + d + p + f - h, (s > 0 || r(s) < u) && (t.left += d + p + f))
                    },
                    top: function(t, e) {
                        var i, s, n = e.within,
                            o = n.offset.top + n.scrollTop,
                            a = n.height,
                            h = n.isWindow ? n.scrollTop : n.offset.top,
                            l = t.top - e.collisionPosition.marginTop,
                            c = l - h,
                            u = l + e.collisionHeight - a - h,
                            d = "top" === e.my[1],
                            p = d ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0,
                            f = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0,
                            m = -2 * e.offset[1];
                        0 > c ? (s = t.top + p + f + m + e.collisionHeight - a - o, t.top + p + f + m > c && (0 > s || s < r(c)) && (t.top += p + f + m)) : u > 0 && (i = t.top - e.collisionPosition.marginTop + p + f + m - h, t.top + p + f + m > u && (i > 0 || r(i) < u) && (t.top += p + f + m))
                    }
                },
                flipfit: {
                    left: function() {
                        t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments)
                    },
                    top: function() {
                        t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments)
                    }
                }
            },
            function() {
                var e, i, s, n, a, r = document.getElementsByTagName("body")[0],
                    h = document.createElement("div");
                e = document.createElement(r ? "div" : "body"), s = {
                    visibility: "hidden",
                    width: 0,
                    height: 0,
                    border: 0,
                    margin: 0,
                    background: "none"
                }, r && t.extend(s, {
                    position: "absolute",
                    left: "-1000px",
                    top: "-1000px"
                });
                for (a in s) e.style[a] = s[a];
                e.appendChild(h), i = r || document.documentElement, i.insertBefore(e, i.firstChild), h.style.cssText = "position: absolute; left: 10.7432222px;", n = t(h).offset().left, o = n > 10 && 11 > n, e.innerHTML = "", i.removeChild(e)
            }()
    }();
    t.ui.position, t.widget("ui.accordion", {
        version: "1.11.0",
        options: {
            active: 0,
            animate: {},
            collapsible: !1,
            event: "click",
            header: "> li > :first-child,> :not(li):even",
            heightStyle: "auto",
            icons: {
                activeHeader: "ui-icon-triangle-1-s",
                header: "ui-icon-triangle-1-e"
            },
            activate: null,
            beforeActivate: null
        },
        hideProps: {
            borderTopWidth: "hide",
            borderBottomWidth: "hide",
            paddingTop: "hide",
            paddingBottom: "hide",
            height: "hide"
        },
        showProps: {
            borderTopWidth: "show",
            borderBottomWidth: "show",
            paddingTop: "show",
            paddingBottom: "show",
            height: "show"
        },
        _create: function() {
            var e = this.options;
            this.prevShow = this.prevHide = t(), this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role", "tablist"), e.collapsible || e.active !== !1 && null != e.active || (e.active = 0), this._processPanels(), e.active < 0 && (e.active += this.headers.length), this._refresh()
        },
        _getCreateEventData: function() {
            return {
                header: this.active,
                panel: this.active.length ? this.active.next() : t()
            }
        },
        _createIcons: function() {
            var e = this.options.icons;
            e && (t("<span>").addClass("ui-accordion-header-icon ui-icon " + e.header).prependTo(this.headers), this.active.children(".ui-accordion-header-icon").removeClass(e.header).addClass(e.activeHeader), this.headers.addClass("ui-accordion-icons"))
        },
        _destroyIcons: function() {
            this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove()
        },
        _destroy: function() {
            var t;
            this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"), this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").removeUniqueId(), this._destroyIcons(), t = this.headers.next().removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").css("display", "").removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeUniqueId(), "content" !== this.options.heightStyle && t.css("height", "")
        },
        _setOption: function(t, e) {
            return "active" === t ? void this._activate(e) : ("event" === t && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(e)), this._super(t, e), "collapsible" !== t || e || this.options.active !== !1 || this._activate(0), "icons" === t && (this._destroyIcons(), e && this._createIcons()), void("disabled" === t && (this.element.toggleClass("ui-state-disabled", !!e).attr("aria-disabled", e), this.headers.add(this.headers.next()).toggleClass("ui-state-disabled", !!e))))
        },
        _keydown: function(e) {
            if (!e.altKey && !e.ctrlKey) {
                var i = t.ui.keyCode,
                    s = this.headers.length,
                    n = this.headers.index(e.target),
                    o = !1;
                switch (e.keyCode) {
                    case i.RIGHT:
                    case i.DOWN:
                        o = this.headers[(n + 1) % s];
                        break;
                    case i.LEFT:
                    case i.UP:
                        o = this.headers[(n - 1 + s) % s];
                        break;
                    case i.SPACE:
                    case i.ENTER:
                        this._eventHandler(e);
                        break;
                    case i.HOME:
                        o = this.headers[0];
                        break;
                    case i.END:
                        o = this.headers[s - 1]
                }
                o && (t(e.target).attr("tabIndex", -1), t(o).attr("tabIndex", 0), o.focus(), e.preventDefault())
            }
        },
        _panelKeyDown: function(e) {
            e.keyCode === t.ui.keyCode.UP && e.ctrlKey && t(e.currentTarget).prev().focus()
        },
        refresh: function() {
            var e = this.options;
            this._processPanels(), e.active === !1 && e.collapsible === !0 || !this.headers.length ? (e.active = !1, this.active = t()) : e.active === !1 ? this._activate(0) : this.active.length && !t.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (e.active = !1, this.active = t()) : this._activate(Math.max(0, e.active - 1)) : e.active = this.headers.index(this.active), this._destroyIcons(), this._refresh()
        },
        _processPanels: function() {
            this.headers = this.element.find(this.options.header).addClass("ui-accordion-header ui-state-default ui-corner-all"), this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide()
        },
        _refresh: function() {
            var e, i = this.options,
                s = i.heightStyle,
                n = this.element.parent();
            this.active = this._findActive(i.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all"), this.active.next().addClass("ui-accordion-content-active").show(), this.headers.attr("role", "tab").each(function() {
                var e = t(this),
                    i = e.uniqueId().attr("id"),
                    s = e.next(),
                    n = s.uniqueId().attr("id");
                e.attr("aria-controls", n), s.attr("aria-labelledby", i)
            }).next().attr("role", "tabpanel"), this.headers.not(this.active).attr({
                "aria-selected": "false",
                "aria-expanded": "false",
                tabIndex: -1
            }).next().attr({
                "aria-hidden": "true"
            }).hide(), this.active.length ? this.active.attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            }).next().attr({
                "aria-hidden": "false"
            }) : this.headers.eq(0).attr("tabIndex", 0), this._createIcons(), this._setupEvents(i.event), "fill" === s ? (e = n.height(), this.element.siblings(":visible").each(function() {
                var i = t(this),
                    s = i.css("position");
                "absolute" !== s && "fixed" !== s && (e -= i.outerHeight(!0))
            }), this.headers.each(function() {
                e -= t(this).outerHeight(!0)
            }), this.headers.next().each(function() {
                t(this).height(Math.max(0, e - t(this).innerHeight() + t(this).height()))
            }).css("overflow", "auto")) : "auto" === s && (e = 0, this.headers.next().each(function() {
                e = Math.max(e, t(this).css("height", "").height())
            }).height(e))
        },
        _activate: function(e) {
            var i = this._findActive(e)[0];
            i !== this.active[0] && (i = i || this.active[0], this._eventHandler({
                target: i,
                currentTarget: i,
                preventDefault: t.noop
            }))
        },
        _findActive: function(e) {
            return "number" == typeof e ? this.headers.eq(e) : t()
        },
        _setupEvents: function(e) {
            var i = {
                keydown: "_keydown"
            };
            e && t.each(e.split(" "), function(t, e) {
                i[e] = "_eventHandler"
            }), this._off(this.headers.add(this.headers.next())), this._on(this.headers, i), this._on(this.headers.next(), {
                keydown: "_panelKeyDown"
            }), this._hoverable(this.headers), this._focusable(this.headers)
        },
        _eventHandler: function(e) {
            var i = this.options,
                s = this.active,
                n = t(e.currentTarget),
                o = n[0] === s[0],
                a = o && i.collapsible,
                r = a ? t() : n.next(),
                h = s.next(),
                l = {
                    oldHeader: s,
                    oldPanel: h,
                    newHeader: a ? t() : n,
                    newPanel: r
                };
            e.preventDefault(), o && !i.collapsible || this._trigger("beforeActivate", e, l) === !1 || (i.active = a ? !1 : this.headers.index(n), this.active = o ? t() : n, this._toggle(l), s.removeClass("ui-accordion-header-active ui-state-active"), i.icons && s.children(".ui-accordion-header-icon").removeClass(i.icons.activeHeader).addClass(i.icons.header), o || (n.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"), i.icons && n.children(".ui-accordion-header-icon").removeClass(i.icons.header).addClass(i.icons.activeHeader), n.next().addClass("ui-accordion-content-active")))
        },
        _toggle: function(e) {
            var i = e.newPanel,
                s = this.prevShow.length ? this.prevShow : e.oldPanel;
            this.prevShow.add(this.prevHide).stop(!0, !0), this.prevShow = i, this.prevHide = s, this.options.animate ? this._animate(i, s, e) : (s.hide(), i.show(), this._toggleComplete(e)), s.attr({
                "aria-hidden": "true"
            }), s.prev().attr("aria-selected", "false"), i.length && s.length ? s.prev().attr({
                tabIndex: -1,
                "aria-expanded": "false"
            }) : i.length && this.headers.filter(function() {
                return 0 === t(this).attr("tabIndex")
            }).attr("tabIndex", -1), i.attr("aria-hidden", "false").prev().attr({
                "aria-selected": "true",
                tabIndex: 0,
                "aria-expanded": "true"
            })
        },
        _animate: function(t, e, i) {
            var s, n, o, a = this,
                r = 0,
                h = t.length && (!e.length || t.index() < e.index()),
                l = this.options.animate || {},
                c = h && l.down || l,
                u = function() {
                    a._toggleComplete(i)
                };
            return "number" == typeof c && (o = c), "string" == typeof c && (n = c), n = n || c.easing || l.easing, o = o || c.duration || l.duration, e.length ? t.length ? (s = t.show().outerHeight(), e.animate(this.hideProps, {
                duration: o,
                easing: n,
                step: function(t, e) {
                    e.now = Math.round(t)
                }
            }), void t.hide().animate(this.showProps, {
                duration: o,
                easing: n,
                complete: u,
                step: function(t, i) {
                    i.now = Math.round(t), "height" !== i.prop ? r += i.now : "content" !== a.options.heightStyle && (i.now = Math.round(s - e.outerHeight() - r), r = 0)
                }
            })) : e.animate(this.hideProps, o, n, u) : t.animate(this.showProps, o, n, u)
        },
        _toggleComplete: function(t) {
            var e = t.oldPanel;
            e.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all"), e.length && (e.parent()[0].className = e.parent()[0].className), this._trigger("activate", null, t)
        }
    }), t.widget("ui.menu", {
        version: "1.11.0",
        defaultElement: "<ul>",
        delay: 300,
        options: {
            icons: {
                submenu: "ui-icon-carat-1-e"
            },
            items: "> *",
            menus: "ul",
            position: {
                my: "left-1 top",
                at: "right top"
            },
            role: "menu",
            blur: null,
            focus: null,
            select: null
        },
        _create: function() {
            this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({
                role: this.options.role,
                tabIndex: 0
            }), this.options.disabled && this.element.addClass("ui-state-disabled").attr("aria-disabled", "true"), this._on({
                "mousedown .ui-menu-item": function(t) {
                    t.preventDefault()
                },
                "click .ui-menu-item": function(e) {
                    var i = t(e.target);
                    !this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(e), e.isPropagationStopped() || (this.mouseHandled = !0), i.has(".ui-menu").length ? this.expand(e) : !this.element.is(":focus") && t(this.document[0].activeElement).closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))
                },
                "mouseenter .ui-menu-item": function(e) {
                    var i = t(e.currentTarget);
                    i.siblings(".ui-state-active").removeClass("ui-state-active"), this.focus(e, i)
                },
                mouseleave: "collapseAll",
                "mouseleave .ui-menu": "collapseAll",
                focus: function(t, e) {
                    var i = this.active || this.element.find(this.options.items).eq(0);
                    e || this.focus(t, i)
                },
                blur: function(e) {
                    this._delay(function() {
                        t.contains(this.element[0], this.document[0].activeElement) || this.collapseAll(e)
                    })
                },
                keydown: "_keydown"
            }), this.refresh(), this._on(this.document, {
                click: function(t) {
                    this._closeOnDocumentClick(t) && this.collapseAll(t), this.mouseHandled = !1
                }
            })
        },
        _destroy: function() {
            this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-menu-icons ui-front").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show(), this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").removeUniqueId().removeClass("ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function() {
                var e = t(this);
                e.data("ui-menu-submenu-carat") && e.remove()
            }), this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")
        },
        _keydown: function(e) {
            function i(t) {
                return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
            }
            var s, n, o, a, r, h = !0;
            switch (e.keyCode) {
                case t.ui.keyCode.PAGE_UP:
                    this.previousPage(e);
                    break;
                case t.ui.keyCode.PAGE_DOWN:
                    this.nextPage(e);
                    break;
                case t.ui.keyCode.HOME:
                    this._move("first", "first", e);
                    break;
                case t.ui.keyCode.END:
                    this._move("last", "last", e);
                    break;
                case t.ui.keyCode.UP:
                    this.previous(e);
                    break;
                case t.ui.keyCode.DOWN:
                    this.next(e);
                    break;
                case t.ui.keyCode.LEFT:
                    this.collapse(e);
                    break;
                case t.ui.keyCode.RIGHT:
                    this.active && !this.active.is(".ui-state-disabled") && this.expand(e);
                    break;
                case t.ui.keyCode.ENTER:
                case t.ui.keyCode.SPACE:
                    this._activate(e);
                    break;
                case t.ui.keyCode.ESCAPE:
                    this.collapse(e);
                    break;
                default:
                    h = !1, n = this.previousFilter || "", o = String.fromCharCode(e.keyCode), a = !1, clearTimeout(this.filterTimer), o === n ? a = !0 : o = n + o, r = new RegExp("^" + i(o), "i"), s = this.activeMenu.find(this.options.items).filter(function() {
                        return r.test(t(this).text())
                    }), s = a && -1 !== s.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : s, s.length || (o = String.fromCharCode(e.keyCode), r = new RegExp("^" + i(o), "i"), s = this.activeMenu.find(this.options.items).filter(function() {
                        return r.test(t(this).text())
                    })), s.length ? (this.focus(e, s), s.length > 1 ? (this.previousFilter = o, this.filterTimer = this._delay(function() {
                        delete this.previousFilter
                    }, 1e3)) : delete this.previousFilter) : delete this.previousFilter
            }
            h && e.preventDefault()
        },
        _activate: function(t) {
            this.active.is(".ui-state-disabled") || (this.active.is("[aria-haspopup='true']") ? this.expand(t) : this.select(t))
        },
        refresh: function() {
            var e, i, s = this,
                n = this.options.icons.submenu,
                o = this.element.find(this.options.menus);
            this.element.toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length), o.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-front").hide().attr({
                role: this.options.role,
                "aria-hidden": "true",
                "aria-expanded": "false"
            }).each(function() {
                var e = t(this),
                    i = e.parent(),
                    s = t("<span>").addClass("ui-menu-icon ui-icon " + n).data("ui-menu-submenu-carat", !0);
                i.attr("aria-haspopup", "true").prepend(s), e.attr("aria-labelledby", i.attr("id"))
            }), e = o.add(this.element), i = e.find(this.options.items), i.not(".ui-menu-item").each(function() {
                var e = t(this);
                s._isDivider(e) && e.addClass("ui-widget-content ui-menu-divider")
            }), i.not(".ui-menu-item, .ui-menu-divider").addClass("ui-menu-item").uniqueId().attr({
                tabIndex: -1,
                role: this._itemRole()
            }), i.filter(".ui-state-disabled").attr("aria-disabled", "true"), this.active && !t.contains(this.element[0], this.active[0]) && this.blur()
        },
        _itemRole: function() {
            return {
                menu: "menuitem",
                listbox: "option"
            }[this.options.role]
        },
        _setOption: function(t, e) {
            "icons" === t && this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(e.submenu), "disabled" === t && this.element.toggleClass("ui-state-disabled", !!e).attr("aria-disabled", e), this._super(t, e)
        },
        focus: function(t, e) {
            var i, s;
            this.blur(t, t && "focus" === t.type), this._scrollIntoView(e), this.active = e.first(), s = this.active.addClass("ui-state-focus").removeClass("ui-state-active"), this.options.role && this.element.attr("aria-activedescendant", s.attr("id")), this.active.parent().closest(".ui-menu-item").addClass("ui-state-active"), t && "keydown" === t.type ? this._close() : this.timer = this._delay(function() {
                this._close()
            }, this.delay), i = e.children(".ui-menu"), i.length && t && /^mouse/.test(t.type) && this._startOpening(i), this.activeMenu = e.parent(), this._trigger("focus", t, {
                item: e
            })
        },
        _scrollIntoView: function(e) {
            var i, s, n, o, a, r;
            this._hasScroll() && (i = parseFloat(t.css(this.activeMenu[0], "borderTopWidth")) || 0, s = parseFloat(t.css(this.activeMenu[0], "paddingTop")) || 0, n = e.offset().top - this.activeMenu.offset().top - i - s, o = this.activeMenu.scrollTop(), a = this.activeMenu.height(), r = e.outerHeight(), 0 > n ? this.activeMenu.scrollTop(o + n) : n + r > a && this.activeMenu.scrollTop(o + n - a + r))
        },
        blur: function(t, e) {
            e || clearTimeout(this.timer), this.active && (this.active.removeClass("ui-state-focus"), this.active = null, this._trigger("blur", t, {
                item: this.active
            }))
        },
        _startOpening: function(t) {
            clearTimeout(this.timer), "true" === t.attr("aria-hidden") && (this.timer = this._delay(function() {
                this._close(), this._open(t)
            }, this.delay))
        },
        _open: function(e) {
            var i = t.extend({ of: this.active
            }, this.options.position);
            clearTimeout(this.timer), this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"), e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i)
        },
        collapseAll: function(e, i) {
            clearTimeout(this.timer), this.timer = this._delay(function() {
                var s = i ? this.element : t(e && e.target).closest(this.element.find(".ui-menu"));
                s.length || (s = this.element), this._close(s), this.blur(e), this.activeMenu = s
            }, this.delay)
        },
        _close: function(t) {
            t || (t = this.active ? this.active.parent() : this.element), t.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find(".ui-state-active").not(".ui-state-focus").removeClass("ui-state-active")
        },
        _closeOnDocumentClick: function(e) {
            return !t(e.target).closest(".ui-menu").length
        },
        _isDivider: function(t) {
            return !/[^\-\u2014\u2013\s]/.test(t.text())
        },
        collapse: function(t) {
            var e = this.active && this.active.parent().closest(".ui-menu-item", this.element);
            e && e.length && (this._close(), this.focus(t, e))
        },
        expand: function(t) {
            var e = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
            e && e.length && (this._open(e.parent()), this._delay(function() {
                this.focus(t, e)
            }))
        },
        next: function(t) {
            this._move("next", "first", t)
        },
        previous: function(t) {
            this._move("prev", "last", t)
        },
        isFirstItem: function() {
            return this.active && !this.active.prevAll(".ui-menu-item").length
        },
        isLastItem: function() {
            return this.active && !this.active.nextAll(".ui-menu-item").length
        },
        _move: function(t, e, i) {
            var s;
            this.active && (s = "first" === t || "last" === t ? this.active["first" === t ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[t + "All"](".ui-menu-item").eq(0)), s && s.length && this.active || (s = this.activeMenu.find(this.options.items)[e]()), this.focus(i, s)
        },
        nextPage: function(e) {
            var i, s, n;
            return this.active ? void(this.isLastItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.nextAll(".ui-menu-item").each(function() {
                return i = t(this), i.offset().top - s - n < 0
            }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]()))) : void this.next(e)
        },
        previousPage: function(e) {
            var i, s, n;
            return this.active ? void(this.isFirstItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.prevAll(".ui-menu-item").each(function() {
                return i = t(this), i.offset().top - s + n > 0
            }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items).first()))) : void this.next(e)
        },
        _hasScroll: function() {
            return this.element.outerHeight() < this.element.prop("scrollHeight")
        },
        select: function(e) {
            this.active = this.active || t(e.target).closest(".ui-menu-item");
            var i = {
                item: this.active
            };
            this.active.has(".ui-menu").length || this.collapseAll(e, !0), this._trigger("select", e, i)
        }
    });
    t.widget("ui.autocomplete", {
        version: "1.11.0",
        defaultElement: "<input>",
        options: {
            appendTo: null,
            autoFocus: !1,
            delay: 300,
            minLength: 1,
            position: {
                my: "left top",
                at: "left bottom",
                collision: "none"
            },
            source: null,
            change: null,
            close: null,
            focus: null,
            open: null,
            response: null,
            search: null,
            select: null
        },
        requestIndex: 0,
        pending: 0,
        _create: function() {
            var e, i, s, n = this.element[0].nodeName.toLowerCase(),
                o = "textarea" === n,
                a = "input" === n;
            this.isMultiLine = o ? !0 : a ? !1 : this.element.prop("isContentEditable"), this.valueMethod = this.element[o || a ? "val" : "text"], this.isNewMenu = !0, this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off"), this._on(this.element, {
                keydown: function(n) {
                    if (this.element.prop("readOnly")) return e = !0, s = !0, void(i = !0);
                    e = !1, s = !1, i = !1;
                    var o = t.ui.keyCode;
                    switch (n.keyCode) {
                        case o.PAGE_UP:
                            e = !0, this._move("previousPage", n);
                            break;
                        case o.PAGE_DOWN:
                            e = !0, this._move("nextPage", n);
                            break;
                        case o.UP:
                            e = !0, this._keyEvent("previous", n);
                            break;
                        case o.DOWN:
                            e = !0, this._keyEvent("next", n);
                            break;
                        case o.ENTER:
                            this.menu.active && (e = !0, n.preventDefault(), this.menu.select(n));
                            break;
                        case o.TAB:
                            this.menu.active && this.menu.select(n);
                            break;
                        case o.ESCAPE:
                            this.menu.element.is(":visible") && (this._value(this.term), this.close(n), n.preventDefault());
                            break;
                        default:
                            i = !0, this._searchTimeout(n)
                    }
                },
                keypress: function(s) {
                    if (e) return e = !1, void((!this.isMultiLine || this.menu.element.is(":visible")) && s.preventDefault());
                    if (!i) {
                        var n = t.ui.keyCode;
                        switch (s.keyCode) {
                            case n.PAGE_UP:
                                this._move("previousPage", s);
                                break;
                            case n.PAGE_DOWN:
                                this._move("nextPage", s);
                                break;
                            case n.UP:
                                this._keyEvent("previous", s);
                                break;
                            case n.DOWN:
                                this._keyEvent("next", s)
                        }
                    }
                },
                input: function(t) {
                    return s ? (s = !1, void t.preventDefault()) : void this._searchTimeout(t)
                },
                focus: function() {
                    this.selectedItem = null, this.previous = this._value()
                },
                blur: function(t) {
                    return this.cancelBlur ? void delete this.cancelBlur : (clearTimeout(this.searching), this.close(t), void this._change(t))
                }
            }), this._initSource(), this.menu = t("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({
                role: null
            }).hide().menu("instance"), this._on(this.menu.element, {
                mousedown: function(e) {
                    e.preventDefault(), this.cancelBlur = !0, this._delay(function() {
                        delete this.cancelBlur
                    });
                    var i = this.menu.element[0];
                    t(e.target).closest(".ui-menu-item").length || this._delay(function() {
                        var e = this;
                        this.document.one("mousedown", function(s) {
                            s.target === e.element[0] || s.target === i || t.contains(i, s.target) || e.close()
                        })
                    })
                },
                menufocus: function(e, i) {
                    var s, n;
                    return this.isNewMenu && (this.isNewMenu = !1, e.originalEvent && /^mouse/.test(e.originalEvent.type)) ? (this.menu.blur(), void this.document.one("mousemove", function() {
                        t(e.target).trigger(e.originalEvent)
                    })) : (n = i.item.data("ui-autocomplete-item"), !1 !== this._trigger("focus", e, {
                        item: n
                    }) && e.originalEvent && /^key/.test(e.originalEvent.type) && this._value(n.value), s = i.item.attr("aria-label") || n.value, void(s && jQuery.trim(s).length && (this.liveRegion.children().hide(), t("<div>").text(s).appendTo(this.liveRegion))))
                },
                menuselect: function(t, e) {
                    var i = e.item.data("ui-autocomplete-item"),
                        s = this.previous;
                    this.element[0] !== this.document[0].activeElement && (this.element.focus(), this.previous = s, this._delay(function() {
                        this.previous = s, this.selectedItem = i
                    })), !1 !== this._trigger("select", t, {
                        item: i
                    }) && this._value(i.value), this.term = this._value(), this.close(t), this.selectedItem = i
                }
            }), this.liveRegion = t("<span>", {
                role: "status",
                "aria-live": "assertive",
                "aria-relevant": "additions"
            }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body), this._on(this.window, {
                beforeunload: function() {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _destroy: function() {
            clearTimeout(this.searching), this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete"), this.menu.element.remove(), this.liveRegion.remove()
        },
        _setOption: function(t, e) {
            this._super(t, e), "source" === t && this._initSource(), "appendTo" === t && this.menu.element.appendTo(this._appendTo()), "disabled" === t && e && this.xhr && this.xhr.abort()
        },
        _appendTo: function() {
            var e = this.options.appendTo;
            return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e && e[0] || (e = this.element.closest(".ui-front")), e.length || (e = this.document[0].body), e
        },
        _initSource: function() {
            var e, i, s = this;
            t.isArray(this.options.source) ? (e = this.options.source, this.source = function(i, s) {
                s(t.ui.autocomplete.filter(e, i.term))
            }) : "string" == typeof this.options.source ? (i = this.options.source, this.source = function(e, n) {
                s.xhr && s.xhr.abort(), s.xhr = t.ajax({
                    url: i,
                    data: e,
                    dataType: "json",
                    success: function(t) {
                        n(t)
                    },
                    error: function() {
                        n([])
                    }
                })
            }) : this.source = this.options.source
        },
        _searchTimeout: function(t) {
            clearTimeout(this.searching), this.searching = this._delay(function() {
                var e = this.term === this._value(),
                    i = this.menu.element.is(":visible"),
                    s = t.altKey || t.ctrlKey || t.metaKey || t.shiftKey;
                (!e || e && !i && !s) && (this.selectedItem = null, this.search(null, t))
            }, this.options.delay)
        },
        search: function(t, e) {
            return t = null != t ? t : this._value(), this.term = this._value(), t.length < this.options.minLength ? this.close(e) : this._trigger("search", e) !== !1 ? this._search(t) : void 0
        },
        _search: function(t) {
            this.pending++, this.element.addClass("ui-autocomplete-loading"), this.cancelSearch = !1, this.source({
                term: t
            }, this._response())
        },
        _response: function() {
            var e = ++this.requestIndex;
            return t.proxy(function(t) {
                e === this.requestIndex && this.__response(t), this.pending--, this.pending || this.element.removeClass("ui-autocomplete-loading")
            }, this)
        },
        __response: function(t) {
            t && (t = this._normalize(t)), this._trigger("response", null, {
                content: t
            }), !this.options.disabled && t && t.length && !this.cancelSearch ? (this._suggest(t), this._trigger("open")) : this._close()
        },
        close: function(t) {
            this.cancelSearch = !0, this._close(t)
        },
        _close: function(t) {
            this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", t))
        },
        _change: function(t) {
            this.previous !== this._value() && this._trigger("change", t, {
                item: this.selectedItem
            })
        },
        _normalize: function(e) {
            return e.length && e[0].label && e[0].value ? e : t.map(e, function(e) {
                return "string" == typeof e ? {
                    label: e,
                    value: e
                } : t.extend({}, e, {
                    label: e.label || e.value,
                    value: e.value || e.label
                })
            })
        },
        _suggest: function(e) {
            var i = this.menu.element.empty();
            this._renderMenu(i, e), this.isNewMenu = !0, this.menu.refresh(), i.show(), this._resizeMenu(), i.position(t.extend({ of: this.element
            }, this.options.position)), this.options.autoFocus && this.menu.next()
        },
        _resizeMenu: function() {
            var t = this.menu.element;
            t.outerWidth(Math.max(t.width("").outerWidth() + 1, this.element.outerWidth()))
        },
        _renderMenu: function(e, i) {
            var s = this;
            t.each(i, function(t, i) {
                s._renderItemData(e, i)
            })
        },
        _renderItemData: function(t, e) {
            return this._renderItem(t, e).data("ui-autocomplete-item", e)
        },
        _renderItem: function(e, i) {
            return t("<li>").text(i.label).appendTo(e)
        },
        _move: function(t, e) {
            return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(t) || this.menu.isLastItem() && /^next/.test(t) ? (this.isMultiLine || this._value(this.term), void this.menu.blur()) : void this.menu[t](e) : void this.search(null, e)
        },
        widget: function() {
            return this.menu.element
        },
        _value: function() {
            return this.valueMethod.apply(this.element, arguments)
        },
        _keyEvent: function(t, e) {
            (!this.isMultiLine || this.menu.element.is(":visible")) && (this._move(t, e), e.preventDefault())
        }
    }), t.extend(t.ui.autocomplete, {
        escapeRegex: function(t) {
            return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
        },
        filter: function(e, i) {
            var s = new RegExp(t.ui.autocomplete.escapeRegex(i), "i");
            return t.grep(e, function(t) {
                return s.test(t.label || t.value || t)
            })
        }
    }), t.widget("ui.autocomplete", t.ui.autocomplete, {
        options: {
            messages: {
                noResults: "No search results.",
                results: function(t) {
                    return t + (t > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate."
                }
            }
        },
        __response: function(e) {
            var i;
            this._superApply(arguments), this.options.disabled || this.cancelSearch || (i = e && e.length ? this.options.messages.results(e.length) : this.options.messages.noResults, this.liveRegion.children().hide(), t("<div>").text(i).appendTo(this.liveRegion))
        }
    });
    var u, d = (t.ui.autocomplete, "ui-button ui-widget ui-state-default ui-corner-all"),
        p = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
        f = function() {
            var e = t(this);
            setTimeout(function() {
                e.find(":ui-button").button("refresh")
            }, 1)
        },
        m = function(e) {
            var i = e.name,
                s = e.form,
                n = t([]);
            return i && (i = i.replace(/'/g, "\\'"), n = s ? t(s).find("[name='" + i + "'][type=radio]") : t("[name='" + i + "'][type=radio]", e.ownerDocument).filter(function() {
                return !this.form
            })), n
        };
    t.widget("ui.button", {
        version: "1.11.0",
        defaultElement: "<button>",
        options: {
            disabled: null,
            text: !0,
            label: null,
            icons: {
                primary: null,
                secondary: null
            }
        },
        _create: function() {
            this.element.closest("form").unbind("reset" + this.eventNamespace).bind("reset" + this.eventNamespace, f), "boolean" != typeof this.options.disabled ? this.options.disabled = !!this.element.prop("disabled") : this.element.prop("disabled", this.options.disabled), this._determineButtonType(), this.hasTitle = !!this.buttonElement.attr("title");
            var e = this,
                i = this.options,
                s = "checkbox" === this.type || "radio" === this.type,
                n = s ? "" : "ui-state-active";
            null === i.label && (i.label = "input" === this.type ? this.buttonElement.val() : this.buttonElement.html()), this._hoverable(this.buttonElement), this.buttonElement.addClass(d).attr("role", "button").bind("mouseenter" + this.eventNamespace, function() {
                i.disabled || this === u && t(this).addClass("ui-state-active")
            }).bind("mouseleave" + this.eventNamespace, function() {
                i.disabled || t(this).removeClass(n)
            }).bind("click" + this.eventNamespace, function(t) {
                i.disabled && (t.preventDefault(), t.stopImmediatePropagation())
            }), this._on({
                focus: function() {
                    this.buttonElement.addClass("ui-state-focus")
                },
                blur: function() {
                    this.buttonElement.removeClass("ui-state-focus")
                }
            }), s && this.element.bind("change" + this.eventNamespace, function() {
                e.refresh()
            }), "checkbox" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function() {
                return i.disabled ? !1 : void 0
            }) : "radio" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function() {
                if (i.disabled) return !1;
                t(this).addClass("ui-state-active"), e.buttonElement.attr("aria-pressed", "true");
                var s = e.element[0];
                m(s).not(s).map(function() {
                    return t(this).button("widget")[0]
                }).removeClass("ui-state-active").attr("aria-pressed", "false")
            }) : (this.buttonElement.bind("mousedown" + this.eventNamespace, function() {
                return i.disabled ? !1 : (t(this).addClass("ui-state-active"), u = this, void e.document.one("mouseup", function() {
                    u = null
                }))
            }).bind("mouseup" + this.eventNamespace, function() {
                return i.disabled ? !1 : void t(this).removeClass("ui-state-active")
            }).bind("keydown" + this.eventNamespace, function(e) {
                return i.disabled ? !1 : void((e.keyCode === t.ui.keyCode.SPACE || e.keyCode === t.ui.keyCode.ENTER) && t(this).addClass("ui-state-active"))
            }).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, function() {
                t(this).removeClass("ui-state-active")
            }), this.buttonElement.is("a") && this.buttonElement.keyup(function(e) {
                e.keyCode === t.ui.keyCode.SPACE && t(this).click()
            })), this._setOption("disabled", i.disabled), this._resetButton()
        },
        _determineButtonType: function() {
            var t, e, i;
            this.element.is("[type=checkbox]") ? this.type = "checkbox" : this.element.is("[type=radio]") ? this.type = "radio" : this.element.is("input") ? this.type = "input" : this.type = "button", "checkbox" === this.type || "radio" === this.type ? (t = this.element.parents().last(), e = "label[for='" + this.element.attr("id") + "']", this.buttonElement = t.find(e), this.buttonElement.length || (t = t.length ? t.siblings() : this.element.siblings(), this.buttonElement = t.filter(e), this.buttonElement.length || (this.buttonElement = t.find(e))), this.element.addClass("ui-helper-hidden-accessible"), i = this.element.is(":checked"), i && this.buttonElement.addClass("ui-state-active"), this.buttonElement.prop("aria-pressed", i)) : this.buttonElement = this.element
        },
        widget: function() {
            return this.buttonElement
        },
        _destroy: function() {
            this.element.removeClass("ui-helper-hidden-accessible"), this.buttonElement.removeClass(d + " ui-state-active " + p).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()), this.hasTitle || this.buttonElement.removeAttr("title")
        },
        _setOption: function(t, e) {
            return this._super(t, e), "disabled" === t ? (this.widget().toggleClass("ui-state-disabled", !!e), this.element.prop("disabled", !!e), void(e && ("checkbox" === this.type || "radio" === this.type ? this.buttonElement.removeClass("ui-state-focus") : this.buttonElement.removeClass("ui-state-focus ui-state-active")))) : void this._resetButton()
        },
        refresh: function() {
            var e = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled");
            e !== this.options.disabled && this._setOption("disabled", e), "radio" === this.type ? m(this.element[0]).each(function() {
                t(this).is(":checked") ? t(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") : t(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false")
            }) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false"))
        },
        _resetButton: function() {
            if ("input" === this.type) return void(this.options.label && this.element.val(this.options.label));
            var e = this.buttonElement.removeClass(p),
                i = t("<span></span>", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(e.empty()).text(),
                s = this.options.icons,
                n = s.primary && s.secondary,
                o = [];
            s.primary || s.secondary ? (this.options.text && o.push("ui-button-text-icon" + (n ? "s" : s.primary ? "-primary" : "-secondary")), s.primary && e.prepend("<span class='ui-button-icon-primary ui-icon " + s.primary + "'></span>"), s.secondary && e.append("<span class='ui-button-icon-secondary ui-icon " + s.secondary + "'></span>"), this.options.text || (o.push(n ? "ui-button-icons-only" : "ui-button-icon-only"), this.hasTitle || e.attr("title", t.trim(i)))) : o.push("ui-button-text-only"), e.addClass(o.join(" "))
        }
    }), t.widget("ui.buttonset", {
        version: "1.11.0",
        options: {
            items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"
        },
        _create: function() {
            this.element.addClass("ui-buttonset")
        },
        _init: function() {
            this.refresh()
        },
        _setOption: function(t, e) {
            "disabled" === t && this.buttons.button("option", t, e), this._super(t, e)
        },
        refresh: function() {
            var e = "rtl" === this.element.css("direction"),
                i = this.element.find(this.options.items),
                s = i.filter(":ui-button");
            i.not(":ui-button").button(), s.button("refresh"), this.buttons = i.map(function() {
                return t(this).button("widget")[0]
            }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(e ? "ui-corner-right" : "ui-corner-left").end().filter(":last").addClass(e ? "ui-corner-left" : "ui-corner-right").end().end()
        },
        _destroy: function() {
            this.element.removeClass("ui-buttonset"), this.buttons.map(function() {
                return t(this).button("widget")[0]
            }).removeClass("ui-corner-left ui-corner-right").end().button("destroy")
        }
    });
    t.ui.button;
    t.extend(t.ui, {
        datepicker: {
            version: "1.11.0"
        }
    });
    var g;
    t.extend(n.prototype, {
        markerClassName: "hasDatepicker",
        maxRows: 4,
        _widgetDatepicker: function() {
            return this.dpDiv
        },
        setDefaults: function(t) {
            return a(this._defaults, t || {}), this
        },
        _attachDatepicker: function(e, i) {
            var s, n, o;
            s = e.nodeName.toLowerCase(), n = "div" === s || "span" === s, e.id || (this.uuid += 1, e.id = "dp" + this.uuid), o = this._newInst(t(e), n), o.settings = t.extend({}, i || {}), "input" === s ? this._connectDatepicker(e, o) : n && this._inlineDatepicker(e, o)
        },
        _newInst: function(e, i) {
            var s = e[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1");
            return {
                id: s,
                input: e,
                selectedDay: 0,
                selectedMonth: 0,
                selectedYear: 0,
                drawMonth: 0,
                drawYear: 0,
                inline: i,
                dpDiv: i ? o(t("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
            }
        },
        _connectDatepicker: function(e, i) {
            var s = t(e);
            i.append = t([]), i.trigger = t([]), s.hasClass(this.markerClassName) || (this._attachments(s, i), s.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp), i.settings.defaultDate && this._setDate(i, i.settings.defaultDate), this._autoSize(i), t.data(e, "datepicker", i), i.settings.disabled && this._disableDatepicker(e))
        },
        _attachments: function(e, i) {
            var s, n, o, a = this._get(i, "appendText"),
                r = this._get(i, "isRTL");
            i.append && i.append.remove(), a && (i.append = t("<span class='" + this._appendClass + "'>" + a + "</span>"), e[r ? "before" : "after"](i.append)), e.unbind("focus", this._showDatepicker), i.trigger && i.trigger.remove(), s = this._get(i, "showOn"), ("focus" === s || "both" === s) && e.focus(this._showDatepicker), ("button" === s || "both" === s) && (n = this._get(i, "buttonText"), o = this._get(i, "buttonImage"), i.trigger = t(this._get(i, "buttonImageOnly") ? t("<img/>").addClass(this._triggerClass).attr({
                src: o,
                alt: n,
                title: n
            }) : t("<button type='button'></button>").addClass(this._triggerClass).html(o ? t("<img/>").attr({
                src: o,
                alt: n,
                title: n
            }) : n)), e[r ? "before" : "after"](i.trigger), i.trigger.click(function() {
                return t.datepicker._datepickerShowing && t.datepicker._lastInput === e[0] ? t.datepicker._hideDatepicker() : t.datepicker._datepickerShowing && t.datepicker._lastInput !== e[0] ? (t.datepicker._hideDatepicker(), t.datepicker._showDatepicker(e[0])) : t.datepicker._showDatepicker(e[0]), !1
            }))
        },
        _autoSize: function(t) {
            if (this._get(t, "autoSize") && !t.inline) {
                var e, i, s, n, o = new Date(2009, 11, 20),
                    a = this._get(t, "dateFormat");
                a.match(/[DM]/) && (e = function(t) {
                    for (i = 0, s = 0, n = 0; n < t.length; n++) t[n].length > i && (i = t[n].length, s = n);
                    return s
                }, o.setMonth(e(this._get(t, a.match(/MM/) ? "monthNames" : "monthNamesShort"))), o.setDate(e(this._get(t, a.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - o.getDay())), t.input.attr("size", this._formatDate(t, o).length)
            }
        },
        _inlineDatepicker: function(e, i) {
            var s = t(e);
            s.hasClass(this.markerClassName) || (s.addClass(this.markerClassName).append(i.dpDiv), t.data(e, "datepicker", i), this._setDate(i, this._getDefaultDate(i), !0), this._updateDatepicker(i), this._updateAlternate(i), i.settings.disabled && this._disableDatepicker(e), i.dpDiv.css("display", "block"))
        },
        _dialogDatepicker: function(e, i, s, n, o) {
            var r, h, l, c, u, d = this._dialogInst;
            return d || (this.uuid += 1, r = "dp" + this.uuid, this._dialogInput = t("<input type='text' id='" + r + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.keydown(this._doKeyDown), t("body").append(this._dialogInput), d = this._dialogInst = this._newInst(this._dialogInput, !1), d.settings = {}, t.data(this._dialogInput[0], "datepicker", d)), a(d.settings, n || {}), i = i && i.constructor === Date ? this._formatDate(d, i) : i, this._dialogInput.val(i), this._pos = o ? o.length ? o : [o.pageX, o.pageY] : null, this._pos || (h = document.documentElement.clientWidth, l = document.documentElement.clientHeight, c = document.documentElement.scrollLeft || document.body.scrollLeft, u = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [h / 2 - 100 + c, l / 2 - 150 + u]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), d.settings.onSelect = s, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), this._showDatepicker(this._dialogInput[0]), t.blockUI && t.blockUI(this.dpDiv), t.data(this._dialogInput[0], "datepicker", d), this
        },
        _destroyDatepicker: function(e) {
            var i, s = t(e),
                n = t.data(e, "datepicker");
            s.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), t.removeData(e, "datepicker"), "input" === i ? (n.append.remove(), n.trigger.remove(), s.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp)) : ("div" === i || "span" === i) && s.removeClass(this.markerClassName).empty())
        },
        _enableDatepicker: function(e) {
            var i, s, n = t(e),
                o = t.data(e, "datepicker");
            n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !1, o.trigger.filter("button").each(function() {
                this.disabled = !1
            }).end().filter("img").css({
                opacity: "1.0",
                cursor: ""
            })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), s.children().removeClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = t.map(this._disabledInputs, function(t) {
                return t === e ? null : t
            }))
        },
        _disableDatepicker: function(e) {
            var i, s, n = t(e),
                o = t.data(e, "datepicker");
            n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !0, o.trigger.filter("button").each(function() {
                this.disabled = !0
            }).end().filter("img").css({
                opacity: "0.5",
                cursor: "default"
            })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), s.children().addClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = t.map(this._disabledInputs, function(t) {
                return t === e ? null : t
            }), this._disabledInputs[this._disabledInputs.length] = e)
        },
        _isDisabledDatepicker: function(t) {
            if (!t) return !1;
            for (var e = 0; e < this._disabledInputs.length; e++)
                if (this._disabledInputs[e] === t) return !0;
            return !1
        },
        _getInst: function(e) {
            try {
                return t.data(e, "datepicker")
            } catch (i) {
                throw "Missing instance data for this datepicker"
            }
        },
        _optionDatepicker: function(e, i, s) {
            var n, o, r, h, l = this._getInst(e);
            return 2 === arguments.length && "string" == typeof i ? "defaults" === i ? t.extend({}, t.datepicker._defaults) : l ? "all" === i ? t.extend({}, l.settings) : this._get(l, i) : null : (n = i || {}, "string" == typeof i && (n = {}, n[i] = s), void(l && (this._curInst === l && this._hideDatepicker(), o = this._getDateDatepicker(e, !0), r = this._getMinMaxDate(l, "min"), h = this._getMinMaxDate(l, "max"), a(l.settings, n), null !== r && void 0 !== n.dateFormat && void 0 === n.minDate && (l.settings.minDate = this._formatDate(l, r)), null !== h && void 0 !== n.dateFormat && void 0 === n.maxDate && (l.settings.maxDate = this._formatDate(l, h)), "disabled" in n && (n.disabled ? this._disableDatepicker(e) : this._enableDatepicker(e)), this._attachments(t(e), l), this._autoSize(l), this._setDate(l, o), this._updateAlternate(l), this._updateDatepicker(l))))
        },
        _changeDatepicker: function(t, e, i) {
            this._optionDatepicker(t, e, i)
        },
        _refreshDatepicker: function(t) {
            var e = this._getInst(t);
            e && this._updateDatepicker(e)
        },
        _setDateDatepicker: function(t, e) {
            var i = this._getInst(t);
            i && (this._setDate(i, e), this._updateDatepicker(i), this._updateAlternate(i))
        },
        _getDateDatepicker: function(t, e) {
            var i = this._getInst(t);
            return i && !i.inline && this._setDateFromField(i, e), i ? this._getDate(i) : null
        },
        _doKeyDown: function(e) {
            var i, s, n, o = t.datepicker._getInst(e.target),
                a = !0,
                r = o.dpDiv.is(".ui-datepicker-rtl");
            if (o._keyEvent = !0, t.datepicker._datepickerShowing) switch (e.keyCode) {
                case 9:
                    t.datepicker._hideDatepicker(), a = !1;
                    break;
                case 13:
                    return n = t("td." + t.datepicker._dayOverClass + ":not(." + t.datepicker._currentClass + ")", o.dpDiv), n[0] && t.datepicker._selectDay(e.target, o.selectedMonth, o.selectedYear, n[0]), i = t.datepicker._get(o, "onSelect"), i ? (s = t.datepicker._formatDate(o), i.apply(o.input ? o.input[0] : null, [s, o])) : t.datepicker._hideDatepicker(), !1;
                case 27:
                    t.datepicker._hideDatepicker();
                    break;
                case 33:
                    t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
                    break;
                case 34:
                    t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
                    break;
                case 35:
                    (e.ctrlKey || e.metaKey) && t.datepicker._clearDate(e.target), a = e.ctrlKey || e.metaKey;
                    break;
                case 36:
                    (e.ctrlKey || e.metaKey) && t.datepicker._gotoToday(e.target), a = e.ctrlKey || e.metaKey;
                    break;
                case 37:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? 1 : -1, "D"), a = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
                    break;
                case 38:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, -7, "D"), a = e.ctrlKey || e.metaKey;
                    break;
                case 39:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? -1 : 1, "D"), a = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
                    break;
                case 40:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, 7, "D"), a = e.ctrlKey || e.metaKey;
                    break;
                default:
                    a = !1
            } else 36 === e.keyCode && e.ctrlKey ? t.datepicker._showDatepicker(this) : a = !1;
            a && (e.preventDefault(), e.stopPropagation())
        },
        _doKeyPress: function(e) {
            var i, s, n = t.datepicker._getInst(e.target);
            return t.datepicker._get(n, "constrainInput") ? (i = t.datepicker._possibleChars(t.datepicker._get(n, "dateFormat")), s = String.fromCharCode(null == e.charCode ? e.keyCode : e.charCode), e.ctrlKey || e.metaKey || " " > s || !i || i.indexOf(s) > -1) : void 0
        },
        _doKeyUp: function(e) {
            var i, s = t.datepicker._getInst(e.target);
            if (s.input.val() !== s.lastVal) try {
                i = t.datepicker.parseDate(t.datepicker._get(s, "dateFormat"), s.input ? s.input.val() : null, t.datepicker._getFormatConfig(s)), i && (t.datepicker._setDateFromField(s), t.datepicker._updateAlternate(s), t.datepicker._updateDatepicker(s))
            } catch (n) {}
            return !0
        },
        _showDatepicker: function(e) {
            if (e = e.target || e, "input" !== e.nodeName.toLowerCase() && (e = t("input", e.parentNode)[0]), !t.datepicker._isDisabledDatepicker(e) && t.datepicker._lastInput !== e) {
                var i, n, o, r, h, l, c;
                i = t.datepicker._getInst(e), t.datepicker._curInst && t.datepicker._curInst !== i && (t.datepicker._curInst.dpDiv.stop(!0, !0), i && t.datepicker._datepickerShowing && t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])), n = t.datepicker._get(i, "beforeShow"), o = n ? n.apply(e, [e, i]) : {}, o !== !1 && (a(i.settings, o), i.lastVal = null, t.datepicker._lastInput = e, t.datepicker._setDateFromField(i), t.datepicker._inDialog && (e.value = ""), t.datepicker._pos || (t.datepicker._pos = t.datepicker._findPos(e), t.datepicker._pos[1] += e.offsetHeight), r = !1, t(e).parents().each(function() {
                    return r |= "fixed" === t(this).css("position"), !r
                }), h = {
                    left: t.datepicker._pos[0],
                    top: t.datepicker._pos[1]
                }, t.datepicker._pos = null, i.dpDiv.empty(), i.dpDiv.css({
                    position: "absolute",
                    display: "block",
                    top: "-1000px"
                }), t.datepicker._updateDatepicker(i), h = t.datepicker._checkOffset(i, h, r), i.dpDiv.css({
                    position: t.datepicker._inDialog && t.blockUI ? "static" : r ? "fixed" : "absolute",
                    display: "none",
                    left: h.left + "px",
                    top: h.top + "px"
                }), i.inline || (l = t.datepicker._get(i, "showAnim"), c = t.datepicker._get(i, "duration"), i.dpDiv.css("z-index", s(t(e)) + 1), t.datepicker._datepickerShowing = !0, t.effects && t.effects.effect[l] ? i.dpDiv.show(l, t.datepicker._get(i, "showOptions"), c) : i.dpDiv[l || "show"](l ? c : null), t.datepicker._shouldFocusInput(i) && i.input.focus(), t.datepicker._curInst = i))
            }
        },
        _updateDatepicker: function(e) {
            this.maxRows = 4, g = e;
            var i = this._generateHTML(e);
            e.dpDiv.empty().append(i[0]), e.settings.timepicker && e.dpDiv.append(this._generateTimeDropDown(e)), t(".ui-time-holder").perfectScrollbar(), this._get(e, "showButtonPanel") && e.dpDiv.append(i[1]), this._getDateTimeInset(e), t(".highlight-datetime .hl-time").text(t(".ui-time-slot.active").text()), this._attachHandlers(e), e.dpDiv.find("." + this._dayOverClass + " a");
            var s, n = this._getNumberOfMonths(e),
                o = n[1],
                a = 17;
            e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), o > 1 && e.dpDiv.addClass("ui-datepicker-multi-" + o).css("width", a * o + "em"), e.dpDiv[(1 !== n[0] || 1 !== n[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), e.dpDiv[(this._get(e, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), e === t.datepicker._curInst && t.datepicker._datepickerShowing && t.datepicker._shouldFocusInput(e) && e.input.focus(), e.yearshtml && (s = e.yearshtml, setTimeout(function() {
                s === e.yearshtml && e.yearshtml && e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml), s = e.yearshtml = null
            }, 0))
        },
        _shouldFocusInput: function(t) {
            return t.input && t.input.is(":visible") && !t.input.is(":disabled") && !t.input.is(":focus")
        },
        _checkOffset: function(e, i, s) {
            var n = e.dpDiv.outerWidth(),
                o = e.dpDiv.outerHeight(),
                a = e.input ? e.input.outerWidth() : 0,
                r = e.input ? e.input.outerHeight() : 0,
                h = document.documentElement.clientWidth + (s ? 0 : t(document).scrollLeft()),
                l = document.documentElement.clientHeight + (s ? 0 : t(document).scrollTop());
            return i.left -= this._get(e, "isRTL") ? n - a : 0, i.left -= s && i.left === e.input.offset().left ? t(document).scrollLeft() : 0, i.top -= s && i.top === e.input.offset().top + r ? t(document).scrollTop() : 0, i.left -= Math.min(i.left, i.left + n > h && h > n ? Math.abs(i.left + n - h) : 0), i.top -= Math.min(i.top, i.top + o > l && l > o ? Math.abs(o + r) : 0), i
        },
        _findPos: function(e) {
            for (var i, s = this._getInst(e), n = this._get(s, "isRTL"); e && ("hidden" === e.type || 1 !== e.nodeType || t.expr.filters.hidden(e));) e = e[n ? "previousSibling" : "nextSibling"];
            return i = t(e).offset(), [i.left, i.top]
        },
        _hideDatepicker: function(e) {
            var i, s, n, o, a = this._curInst;
            !a || e && a !== t.data(e, "datepicker") || this._datepickerShowing && (i = this._get(a, "showAnim"), s = this._get(a, "duration"), n = function() {
                t.datepicker._tidyDialog(a)
            }, t.effects && (t.effects.effect[i] || t.effects[i]) ? a.dpDiv.hide(i, t.datepicker._get(a, "showOptions"), s, n) : a.dpDiv["slideDown" === i ? "slideUp" : "fadeIn" === i ? "fadeOut" : "hide"](i ? s : null, n), i || n(), this._datepickerShowing = !1, o = this._get(a, "onClose"), o && o.apply(a.input ? a.input[0] : null, [a.input ? a.input.val() : "", a]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
                position: "absolute",
                left: "0",
                top: "-100px"
            }), t.blockUI && (t.unblockUI(), t("body").append(this.dpDiv))), this._inDialog = !1)
        },
        _tidyDialog: function(t) {
            t.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")
        },
        _checkExternalClick: function(e) {
            if (t.datepicker._curInst) {
                var i = t(e.target),
                    s = t.datepicker._getInst(i[0]);
                (i[0].id !== t.datepicker._mainDivId && 0 === i.parents("#" + t.datepicker._mainDivId).length && !i.hasClass(t.datepicker.markerClassName) && !i.closest("." + t.datepicker._triggerClass).length && t.datepicker._datepickerShowing && (!t.datepicker._inDialog || !t.blockUI) || i.hasClass(t.datepicker.markerClassName) && t.datepicker._curInst !== s) && t.datepicker._hideDatepicker()
            }
        },
        _adjustDate: function(e, i, s) {
            var n = t(e),
                o = this._getInst(n[0]);
            this._isDisabledDatepicker(n[0]) || (this._adjustInstDate(o, i + ("M" === s ? this._get(o, "showCurrentAtPos") : 0), s), this._updateDatepicker(o))
        },
        _gotoToday: function(e) {
            var i, s = t(e),
                n = this._getInst(s[0]);
            this._get(n, "gotoCurrent") && n.currentDay ? (n.selectedDay = n.currentDay, n.drawMonth = n.selectedMonth = n.currentMonth, n.drawYear = n.selectedYear = n.currentYear) : (i = new Date, n.selectedDay = i.getDate(), n.drawMonth = n.selectedMonth = i.getMonth(), n.drawYear = n.selectedYear = i.getFullYear()), this._notifyChange(n), this._adjustDate(s)
        },
        _selectMonthYear: function(e, i, s) {
            var n = t(e),
                o = this._getInst(n[0]);
            o["selected" + ("M" === s ? "Month" : "Year")] = o["draw" + ("M" === s ? "Month" : "Year")] = parseInt(i.options[i.selectedIndex].value, 10), this._notifyChange(o), this._adjustDate(n)
        },
        _selectTimeSlot: function(e, i, s) {
            t(".time-slot-highlight").removeClass("time-slot-highlight"), t(".highlight-datetime .hl-time").html(t(s).text()), t(s).addClass("time-slot-highlight");
            var n, o = t(e);
            t(s).hasClass(this._unselectableClass) || this._isDisabledDatepicker(o[0]) || (n = this._getInst(o[0]), n.selectedTime = s.getAttribute("data-slot"), this._selectDateTime(e, this._formatDate(n, n.currentDay, n.currentMonth, n.currentYear, n.selectedTime)))
        },
        _selectDay: function(e, i, s, n) {
            var o, a = t(e);
            t(n).hasClass(this._unselectableClass) || this._isDisabledDatepicker(a[0]) || (t(".selected-day").removeClass("selected-day"), t(n).addClass("selected-day"), o = this._getInst(a[0]), o.selectedDay = o.currentDay = t("a", n).html(), o.selectedMonth = o.currentMonth = i, o.selectedYear = o.currentYear = s, this._selectDate(e, this._formatDate(o, o.currentDay, o.currentMonth, o.currentYear)), o.input.trigger("day-changed"), o.input.trigger("change"))
        },
        _clearDate: function(e) {
            var i = t(e);
            this._selectDate(i, "")
        },
        _selectDateTime: function(e, i) {
            var s, n = t(e),
                o = this._getInst(n[0]);
            i = null != i ? i : this._formatDate(o), o.input && o.input.val(i), this._updateAlternate(o), s = this._get(o, "onSelect"), s ? s.apply(o.input ? o.input[0] : null, [i, o]) : o.input && o.input.trigger("change"), this._get(o, "showButtonPanel") || this._hideDatepicker(), this._lastInput = o.input[0], "object" != typeof o.input[0] && o.input.focus(), this._lastInput = null
        },
        _selectDate: function(e, i) {
            var s, n = t(e),
                o = this._getInst(n[0]);
            i = null != i ? i : this._formatDate(o), o.input && o.input.val(i), this._updateAlternate(o), s = this._get(o, "onSelect"), s ? s.apply(o.input ? o.input[0] : null, [i, o]) : o.input && ("undefined" == typeof o.settings.timepicker || o.settings.timepicker === !1) && o.input.trigger("change"), o.inline ? this._updateDatepicker(o) : (("undefined" == typeof o.settings.timepicker || o.settings.timepicker === !1) && this._hideDatepicker(), this._lastInput = o.input[0], "object" != typeof o.input[0] && o.input.focus(), this._lastInput = null)
        },
        _updateAlternate: function(e) {
            var i, s, n, o = this._get(e, "altField");
            o && (i = this._get(e, "altFormat") || this._get(e, "dateFormat"), s = this._getDate(e), n = this.formatDate(i, s, this._getFormatConfig(e)), t(o).each(function() {
                t(this).val(n)
            }))
        },
        noWeekends: function(t) {
            var e = t.getDay();
            return [e > 0 && 6 > e, ""]
        },
        iso8601Week: function(t) {
            var e, i = new Date(t.getTime());
            return i.setDate(i.getDate() + 4 - (i.getDay() || 7)), e = i.getTime(), i.setMonth(0), i.setDate(1), Math.floor(Math.round((e - i) / 864e5) / 7) + 1
        },
        parseDate: function(e, i, s) {
            if (null == e || null == i) throw "Invalid arguments";
            if (i = "object" == typeof i ? i.toString() : i + "", "" === i) return null;
            var n, o, a, r, h = 0,
                l = (s ? s.shortYearCutoff : null) || this._defaults.shortYearCutoff,
                c = "string" != typeof l ? l : (new Date).getFullYear() % 100 + parseInt(l, 10),
                u = (s ? s.dayNamesShort : null) || this._defaults.dayNamesShort,
                d = (s ? s.dayNames : null) || this._defaults.dayNames,
                p = (s ? s.monthNamesShort : null) || this._defaults.monthNamesShort,
                f = (s ? s.monthNames : null) || this._defaults.monthNames,
                m = -1,
                g = -1,
                v = -1,
                _ = -1,
                b = -1,
                y = -1,
                w = !1,
                k = function(t) {
                    var i = n + 1 < e.length && e.charAt(n + 1) === t;
                    return i && n++, i
                },
                x = function(t) {
                    var e = k(t),
                        s = "@" === t ? 14 : "!" === t ? 20 : "y" === t && e ? 4 : "o" === t ? 3 : 2,
                        n = new RegExp("^\\d{1," + s + "}"),
                        o = i.substring(h).match(n);
                    if (!o) throw "Missing number at position " + h;
                    return h += o[0].length, parseInt(o[0], 10)
                },
                D = function(e, s, n) {
                    var o = -1,
                        a = t.map(k(e) ? n : s, function(t, e) {
                            return [
                                [e, t]
                            ]
                        }).sort(function(t, e) {
                            return -(t[1].length - e[1].length)
                        });
                    if (t.each(a, function(t, e) {
                            var s = e[1];
                            return i.substr(h, s.length).toLowerCase() === s.toLowerCase() ? (o = e[0], h += s.length, !1) : void 0
                        }), -1 !== o) return o + 1;
                    throw "Unknown name at position " + h
                },
                C = function() {
                    if (i.charAt(h) !== e.charAt(n)) throw "Unexpected literal at position " + h;
                    h++
                };
            for (n = 0; n < e.length; n++)
                if (w) "'" !== e.charAt(n) || k("'") ? C() : w = !1;
                else switch (e.charAt(n)) {
                    case "d":
                        v = x("d");
                        break;
                    case "D":
                        D("D", u, d);
                        break;
                    case "H":
                        _ = x("H");
                        break;
                    case "i":
                        b = x("i");
                        break;
                    case "o":
                        y = x("o");
                        break;
                    case "m":
                        g = x("m");
                        break;
                    case "M":
                        g = D("M", p, f);
                        break;
                    case "y":
                        m = x("y");
                        break;
                    case "@":
                        r = new Date(x("@")), m = r.getFullYear(), g = r.getMonth() + 1, v = r.getDate();
                        break;
                    case "!":
                        r = new Date((x("!") - this._ticksTo1970) / 1e4), m = r.getFullYear(), g = r.getMonth() + 1, v = r.getDate();
                        break;
                    case "'":
                        k("'") ? C() : w = !0;
                        break;
                    default:
                        C()
                }
            if (h < i.length && (a = i.substr(h), !/^\s+/.test(a))) throw "Extra/unparsed characters found in date: " + a;
            if (-1 === m ? m = (new Date).getFullYear() : 100 > m && (m += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (c >= m ? 0 : -100)), y > -1)
                for (g = 1, v = y;;) {
                    if (o = this._getDaysInMonth(m, g - 1), o >= v) break;
                    g++, v -= o
                }
            if (r = -1 == _ && -1 == b ? this._daylightSavingAdjust(new Date(m, g - 1, v)) : this._daylightSavingAdjust(new Date(m, g - 1, v, _, b)), r.getFullYear() !== m || r.getMonth() + 1 !== g || r.getDate() !== v) throw "Invalid date";
            return r
        },
        ATOM: "yy-mm-dd",
        COOKIE: "D, dd M yy",
        ISO_8601: "yy-mm-dd",
        RFC_822: "D, d M y",
        RFC_850: "DD, dd-M-y",
        RFC_1036: "D, d M y",
        RFC_1123: "D, d M yy",
        RFC_2822: "D, d M yy",
        RSS: "D, d M y",
        TICKS: "!",
        TIMESTAMP: "@",
        W3C: "yy-mm-dd",
        _ticksTo1970: 24 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)) * 60 * 60 * 1e7,
        formatDate: function(t, e, i) {
            if (!e) return "";
            var s, n = (i ? i.dayNamesShort : null) || this._defaults.dayNamesShort,
                o = (i ? i.dayNames : null) || this._defaults.dayNames,
                a = (i ? i.monthNamesShort : null) || this._defaults.monthNamesShort,
                r = (i ? i.monthNames : null) || this._defaults.monthNames,
                h = function(e) {
                    var i = s + 1 < t.length && t.charAt(s + 1) === e;
                    return i && s++, i
                },
                l = function(t, e, i) {
                    var s = "" + e;
                    if (h(t))
                        for (; s.length < i;) s = "0" + s.toString();
                    return s
                },
                c = function(t, e, i, s) {
                    return h(t) ? s[e] : i[e]
                },
                u = "",
                d = !1;
            if (e)
                for (s = 0; s < t.length; s++)
                    if (d) "'" !== t.charAt(s) || h("'") ? u += t.charAt(s) : d = !1;
                    else switch (t.charAt(s)) {
                        case "d":
                            u += l("d", e.getDate(), 2);
                            break;
                        case "D":
                            u += c("D", e.getDay(), n, o);
                            break;
                        case "o":
                            u += l("o", Math.round((new Date(e.getFullYear(), e.getMonth(), e.getDate()).getTime() - new Date(e.getFullYear(), 0, 0).getTime()) / 864e5), 3);
                            break;
                        case "H":
                            u += l("H", e.getHours(), 2);
                            break;
                        case "i":
                            u += l("i", e.getMinutes(), 2);
                            break;
                        case "m":
                            u += l("m", e.getMonth() + 1, 2);
                            break;
                        case "M":
                            u += c("M", e.getMonth(), a, r);
                            break;
                        case "y":
                            u += h("y") ? e.getFullYear() : (e.getYear() % 100 < 10 ? "0" : "") + e.getYear() % 100;
                            break;
                        case "@":
                            u += e.getTime();
                            break;
                        case "#":
                            u += e.getTime() / 1e3;
                            break;
                        case "!":
                            u += 1e4 * e.getTime() + this._ticksTo1970;
                            break;
                        case "'":
                            h("'") ? u += "'" : d = !0;
                            break;
                        default:
                            u += t.charAt(s)
                    }
            return u
        },
        _possibleChars: function(t) {
            var e, i = "",
                s = !1,
                n = function(i) {
                    var s = e + 1 < t.length && t.charAt(e + 1) === i;
                    return s && e++, s
                };
            for (e = 0; e < t.length; e++)
                if (s) "'" !== t.charAt(e) || n("'") ? i += t.charAt(e) : s = !1;
                else switch (t.charAt(e)) {
                    case "d":
                    case "m":
                    case "y":
                    case "@":
                        i += "0123456789";
                        break;
                    case "D":
                    case "M":
                        return null;
                    case "'":
                        n("'") ? i += "'" : s = !0;
                        break;
                    default:
                        i += t.charAt(e)
                }
            return i
        },
        _get: function(t, e) {
            return void 0 !== t.settings[e] ? t.settings[e] : this._defaults[e]
        },
        _setDateFromField: function(t, e) {
            if (t.input.val() !== t.lastVal) {
                var i = this._get(t, "dateFormat"),
                    s = t.lastVal = t.input ? t.input.val() : null,
                    n = this._getDefaultDate(t),
                    o = n,
                    a = this._getFormatConfig(t);
                try {
                    o = this.parseDate(i, s, a) || n
                } catch (r) {
                    s = e ? "" : s
                }
                t.selectedDay = o.getDate(), t.drawMonth = t.selectedMonth = o.getMonth(), t.drawYear = t.selectedYear = o.getFullYear(), t.currentDay = s ? o.getDate() : 0, t.currentMonth = s ? o.getMonth() : 0, t.currentYear = s ? o.getFullYear() : 0, t.drawHours = t.selectedHours = t.currentHours = o.getHours(), t.drawMinutes = t.selectedMinutes = t.currentMinutes = o.getMinutes(), this._adjustInstDate(t)
            }
        },
        _getDefaultDate: function(t) {
            return this._restrictMinMax(t, this._determineDate(t, this._get(t, "defaultDate"), new Date))
        },
        _determineDate: function(e, i, s) {
            var n = function(t) {
                    var e = new Date;
                    return e.setDate(e.getDate() + t), e
                },
                o = function(i) {
                    try {
                        return t.datepicker.parseDate(t.datepicker._get(e, "dateFormat"), i, t.datepicker._getFormatConfig(e))
                    } catch (s) {}
                    for (var n = (i.toLowerCase().match(/^c/) ? t.datepicker._getDate(e) : null) || new Date, o = n.getFullYear(), a = n.getMonth(), r = n.getDate(), h = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, l = h.exec(i); l;) {
                        switch (l[2] || "d") {
                            case "d":
                            case "D":
                                r += parseInt(l[1], 10);
                                break;
                            case "w":
                            case "W":
                                r += 7 * parseInt(l[1], 10);
                                break;
                            case "m":
                            case "M":
                                a += parseInt(l[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(o, a));
                                break;
                            case "y":
                            case "Y":
                                o += parseInt(l[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(o, a))
                        }
                        l = h.exec(i)
                    }
                    return new Date(o, a, r)
                },
                a = null == i || "" === i ? s : "string" == typeof i ? o(i) : "number" == typeof i ? isNaN(i) ? s : n(i) : new Date(i.getTime());
            return a = a && "Invalid Date" === a.toString() ? s : a, a && ("undefined" != typeof e.settings.timepicker && e.settings.timepicker || (a.setHours(0), a.setMinutes(0), a.setSeconds(0), a.setMilliseconds(0))), this._daylightSavingAdjust(a)
        },
        _daylightSavingAdjust: function(t) {
            return t ? t : null
        },
        _setDate: function(t, e, i) {
            var s = !e,
                n = t.selectedMonth,
                o = t.selectedYear,
                a = this._restrictMinMax(t, this._determineDate(t, e, new Date));
            t.selectedDay = t.currentDay = a.getDate(), t.drawMonth = t.selectedMonth = t.currentMonth = a.getMonth(), t.drawYear = t.selectedYear = t.currentYear = a.getFullYear(), t.drawHours = t.selectedHours = t.currentHours = a.getHours(), t.drawMinutes = t.selectedMinutes = t.currentMinutes = a.getMinutes(), n === t.selectedMonth && o === t.selectedYear || i || this._notifyChange(t), this._adjustInstDate(t), t.input && t.input.val(s ? "" : this._formatDate(t))
        },
        _getDateTimeInset: function(e) {
            var i = this._get(e, "monthNamesShort"),
                s = e.selectedDay + " " + i[e.selectedMonth] + " " + e.selectedYear;
            t(".highlight-datetime .hl-date").html(s)
        },
        _getDate: function(t) {
            return !t.currentYear || t.input && "" === t.input.val() ? null : (t.settings.timepicker ? startDate = new Date(t.currentYear, t.currentMonth, t.currentDay, t.currentHours, t.currentMinutes) : startDate = new Date(t.currentYear, t.currentMonth, t.currentDay), startDate)
        },
        _attachHandlers: function(e) {
            var i = this._get(e, "stepMonths"),
                s = "#" + e.id.replace(/\\\\/g, "\\"),
                n = this;
            e.dpDiv.find("[data-handler]").map(function() {
                var o = {
                    prev: function() {
                        t.datepicker._adjustDate(s, -i, "M")
                    },
                    next: function() {
                        t.datepicker._adjustDate(s, +i, "M")
                    },
                    hide: function() {
                        t.datepicker._hideDatepicker(), e.input.trigger("changed")
                    },
                    today: function() {
                        t.datepicker._gotoToday(s)
                    },
                    selectSlot: function() {
                        t.datepicker._selectTimeSlot(s, e, this)
                    },
                    selectDay: function() {
                        return t.datepicker._selectDay(s, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), e.settings.timepicker && (e.dpDiv.find(".ui-time-wrapper").remove(), e.dpDiv.append(t.datepicker._generateTimeDropDown(e)), n._attachHandlers(e), t(".ui-time-holder").perfectScrollbar()), t.datepicker._getDateTimeInset(e), !1
                    },
                    selectMonth: function() {
                        return t.datepicker._selectMonthYear(s, this, "M"), !1
                    },
                    selectYear: function() {
                        return t.datepicker._selectMonthYear(s, this, "Y"), !1
                    }
                };
                t(this).bind(this.getAttribute("data-event"), o[this.getAttribute("data-handler")])
            })
        },
        _generateHTML: function(e) {
            var i, s, n, o, a, r, h, l, c, u, d, p, f, m, g, v, _, b, y, w, k, x, D, C, I, T, M, P, S, z, H, A, N, E, W, O, F, R, L, Y = new Date,
                B = this._daylightSavingAdjust(new Date(Y.getFullYear(), Y.getMonth(), Y.getDate())),
                j = this._get(e, "isRTL"),
                q = this._get(e, "showButtonPanel"),
                K = this._get(e, "hideIfNoPrevNext"),
                U = this._get(e, "navigationAsDateFormat"),
                V = this._getNumberOfMonths(e),
                X = this._get(e, "showCurrentAtPos"),
                $ = this._get(e, "stepMonths"),
                G = 1 !== V[0] || 1 !== V[1],
                Q = this._daylightSavingAdjust(e.currentDay ? new Date(e.currentYear, e.currentMonth, e.currentDay) : new Date(9999, 9, 9)),
                J = this._getMinMaxDate(e, "min"),
                Z = this._getMinMaxDate(e, "max"),
                tt = e.drawMonth - X,
                et = e.drawYear;
            if (0 > tt && (tt += 12, et--), Z)
                for (i = this._daylightSavingAdjust(new Date(Z.getFullYear(), Z.getMonth() - V[0] * V[1] + 1, Z.getDate())), i = J && J > i ? J : i; this._daylightSavingAdjust(new Date(et, tt, 1)) > i;) tt--, 0 > tt && (tt = 11, et--);
            for (e.drawMonth = tt, e.drawYear = et, s = this._get(e, "prevText"), s = U ? this.formatDate(s, this._daylightSavingAdjust(new Date(et, tt - $, 1)), this._getFormatConfig(e)) : s, n = this._canAdjustMonth(e, -1, et, tt) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + s + "'><span class='fa fa-chevron-left'>" + s + "</span></a>" : K ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + s + "'><span class='fa fa-chevron-left'>" + s + "</span></a>", o = this._get(e, "nextText"), o = U ? this.formatDate(o, this._daylightSavingAdjust(new Date(et, tt + $, 1)), this._getFormatConfig(e)) : o, a = this._canAdjustMonth(e, 1, et, tt) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + o + "'><span class='fa fa-chevron-right'>" + o + "</span></a>" : K ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + o + "'><span class='fa fa-chevron-right'>" + o + "</span></a>", r = this._get(e, "currentText"), h = this._get(e, "gotoCurrent") && e.currentDay ? Q : B, r = U ? this.formatDate(r, h, this._getFormatConfig(e)) : r, l = e.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(e, "closeText") + "</button>", c = q ? "<div class='ui-datepicker-buttonpane ui-widget-content'><div class='highlight-datetime'><span class='hl-date'></span><span class='hl-time'></span> </div>" + (j ? l : "") + (this._isInRange(e, h) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + r + "</button>" : "") + (j ? "" : l) + "</div>" : "", u = parseInt(this._get(e, "firstDay"), 10), u = isNaN(u) ? 0 : u, d = this._get(e, "showWeek"), p = this._get(e, "dayNames"), f = this._get(e, "dayNamesMin"), m = this._get(e, "monthNames"), g = this._get(e, "monthNamesShort"), v = this._get(e, "beforeShowDay"), _ = this._get(e, "showOtherMonths"), b = this._get(e, "selectOtherMonths"), y = this._getDefaultDate(e), w = "", x = 0; x < V[0]; x++) {
                for (D = "", this.maxRows = 4, C = 0; C < V[1]; C++) {
                    if (I = this._daylightSavingAdjust(new Date(et, tt, e.selectedDay)), T = " ui-corner-all", M = "", G) {
                        if (M += "<div class='ui-datepicker-group", V[1] > 1) switch (C) {
                            case 0:
                                M += " ui-datepicker-group-first", T = " ui-corner-" + (j ? "right" : "left");
                                break;
                            case V[1] - 1:
                                M += " ui-datepicker-group-last", T = " ui-corner-" + (j ? "left" : "right");
                                break;
                            default:
                                M += " ui-datepicker-group-middle", T = ""
                        }
                        M += "'>"
                    }
                    for (M += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + T + "'>" + (/all|left/.test(T) && 0 === x ? j ? a : n : "") + (/all|right/.test(T) && 0 === x ? j ? n : a : "") + this._generateMonthYearHeader(e, tt, et, J, Z, x > 0 || C > 0, m, g) + "</div><table class='ui-datepicker-calendar'><thead><tr>", P = d ? "<th class='ui-datepicker-week-col'>" + this._get(e, "weekHeader") + "</th>" : "", k = 0; 7 > k; k++) S = (k + u) % 7, P += "<th scope='col'" + ((k + u + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + "><span title='" + p[S] + "'>" + f[S] + "</span></th>";
                    for (M += P + "</tr></thead><tbody>", z = this._getDaysInMonth(et, tt), et === e.selectedYear && tt === e.selectedMonth && (e.selectedDay = Math.min(e.selectedDay, z)), H = (this._getFirstDayOfMonth(et, tt) - u + 7) % 7, A = Math.ceil((H + z) / 7), N = G && this.maxRows > A ? this.maxRows : A, this.maxRows = N, E = this._daylightSavingAdjust(new Date(et, tt, 1 - H)), W = 0; N > W; W++) {
                        for (M += "<tr>", O = d ? "<td class='ui-datepicker-week-col'>" + this._get(e, "calculateWeek")(E) + "</td>" : "", k = 0; 7 > k; k++) F = v ? v.apply(e.input ? e.input[0] : null, [E]) : [!0, ""], R = E.getMonth() !== tt, L = R && !b || !F[0] || J && E.getDate() < J.getDate() && E.getMonth() <= J.getMonth() && E.getYear() <= J.getYear() || Z && E > Z, O += "<td class='" + ((k + u + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (R ? " ui-datepicker-other-month" : "") + (E.getTime() === I.getTime() && tt === e.selectedMonth && e._keyEvent || y.getTime() === E.getTime() && y.getTime() === I.getTime() ? " " + this._dayOverClass : "") + (L ? " " + this._unselectableClass + " ui-state-disabled" : "") + (R && !_ ? "" : " " + F[1] + (E.getTime() === Q.getTime() ? " " + this._currentClass : "") + (E.getTime() === B.getTime() ? " ui-datepicker-today" : "")) + "'" + (R && !_ || !F[2] ? "" : " title='" + F[2].replace(/'/g, "&#39;") + "'") + (L ? "" : " data-handler='selectDay' data-event='click' data-month='" + E.getMonth() + "' data-year='" + E.getFullYear() + "'") + ">" + (R && !_ ? "&#xa0;" : L ? "<span class='ui-state-default'>" + E.getDate() + "</span>" : "<a class='ui-state-default" + (E.getTime() === B.getTime() ? " ui-state-highlight" : "") + (E.getTime() === Q.getTime() ? " ui-state-active" : "") + (R ? " ui-priority-secondary" : "") + "' href='#'>" + E.getDate() + "</a>") + "</td>", E.setDate(E.getDate() + 1), E = this._daylightSavingAdjust(E);
                        M += O + "</tr>"
                    }
                    tt++, tt > 11 && (tt = 0, et++), M += "</tbody></table>" + (G ? "</div>" + (V[0] > 0 && C === V[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : ""), D += M
                }
                w += D
            }
            return w += c, e._keyEvent = !1, w = t(w), [w, c]
        },
        _generateTimeDropDown: function(e) {
            var i = "<div class='ui-time-wrapper'><span class='time-header'>Time</span><ul class='ui-time-holder'></ul></div>";
            i = t(i);
            var s = 900,
                n = 0,
                o = 86400,
                a = "",
                r = e.currentHours ? e.currentHours : 0,
                h = e.currentMinutes ? e.currentMinutes : 0;
            min_date = e.settings.minDate.getDate(), min_hour = e.settings.minDate.getHours(), min_mins = e.settings.minDate.getMinutes();
            var l = e.settings.minDate,
                c = new Date(e.currentYear, parseInt(e.currentMonth), e.currentDay);
            1 == ("" + r).length && (r = "0" + r), round_up = h % (s / 60), h -= round_up, 1 == ("" + h).length && (h = "0" + h);
            for (var u = r + ":" + h, d = new Date(e.lastVal).getDate(); o >= n;) {
                var p = new Date(1970, 0, 1);
                p.setSeconds(n);
                var f = p.getHours(),
                    m = p.getMinutes();
                1 == ("" + f).length && (f = "0" + f), 1 == ("" + m).length && (m = "0" + m);
                var g = new Date(l) < new Date(c);
                if (min_date == parseInt(e.currentDay) && n > 3600 * parseInt(min_hour) + 60 * parseInt(min_mins)) var v = !0;
                if (u == f + ":" + m && d == e.currentDay) {
                    var v = !0;
                    a += "<li class='ui-time-slot active' data-handler='selectSlot' data-event='click' data-slot=" + n + ">" + f + ":" + m + "</li>"
                } else a += g || v ? "<li class='ui-time-slot' data-handler='selectSlot' data-event='click' data-slot=" + n + ">" + f + ":" + m + "</li>" : "<li class='ui-time-slot ui-datepicker-unselectable ui-state-disabled disabled' data-handler='selectSlot' data-event='click' data-slot=" + n + ">" + f + ":" + m + "</li>";
                n += s
            }
            return i.find(".ui-time-holder").append(a), i[0].outerHTML
        },
        _generateMonthYearHeader: function(t, e, i, s, n, o, a, r) {
            var h, l, c, u, d, p, f, m, g = this._get(t, "changeMonth"),
                v = this._get(t, "changeYear"),
                _ = this._get(t, "showMonthAfterYear"),
                b = "<div class='ui-datepicker-title'>",
                y = "";
            if (o || !g) y += "<span class='ui-datepicker-month'>" + a[e] + "</span>";
            else {
                for (h = s && s.getFullYear() === i, l = n && n.getFullYear() === i, y += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", c = 0; 12 > c; c++)(!h || c >= s.getMonth()) && (!l || c <= n.getMonth()) && (y += "<option value='" + c + "'" + (c === e ? " selected='selected'" : "") + ">" + r[c] + "</option>");
                y += "</select>"
            }
            if (_ || (b += y + (!o && g && v ? "" : "&#xa0;")), !t.yearshtml)
                if (t.yearshtml = "", o || !v) b += "<span class='ui-datepicker-year'>" + i + "</span>";
                else {
                    for (u = this._get(t, "yearRange").split(":"), d = (new Date).getFullYear(), p = function(t) {
                            var e = t.match(/c[+\-].*/) ? i + parseInt(t.substring(1), 10) : t.match(/[+\-].*/) ? d + parseInt(t, 10) : parseInt(t, 10);
                            return isNaN(e) ? d : e
                        }, f = p(u[0]), m = Math.max(f, p(u[1] || "")), f = s ? Math.max(f, s.getFullYear()) : f, m = n ? Math.min(m, n.getFullYear()) : m, t.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; m >= f; f++) t.yearshtml += "<option value='" + f + "'" + (f === i ? " selected='selected'" : "") + ">" + f + "</option>";
                    t.yearshtml += "</select>", b += t.yearshtml, t.yearshtml = null
                }
            return b += this._get(t, "yearSuffix"), _ && (b += (!o && g && v ? "" : "&#xa0;") + y), b += "</div>"
        },
        _adjustInstDate: function(t, e, i) {
            var s = t.drawYear + ("Y" === i ? e : 0),
                n = t.drawMonth + ("M" === i ? e : 0),
                o = Math.min(t.selectedDay, this._getDaysInMonth(s, n)) + ("D" === i ? e : 0),
                a = this._restrictMinMax(t, this._daylightSavingAdjust(new Date(s, n, o)));
            t.selectedDay = a.getDate(), t.drawMonth = t.selectedMonth = a.getMonth(), t.drawYear = t.selectedYear = a.getFullYear(), t.drawHours = t.selectedHours = a.getHours(), t.drawMinutes = t.selectedMinutes = a.getMinutes(), ("M" === i || "Y" === i) && this._notifyChange(t)
        },
        _restrictMinMax: function(t, e) {
            var i = this._getMinMaxDate(t, "min"),
                s = this._getMinMaxDate(t, "max"),
                n = i && i > e ? i : e;
            return s && n > s ? s : n
        },
        _notifyChange: function(t) {
            var e = this._get(t, "onChangeMonthYear");
            e && e.apply(t.input ? t.input[0] : null, [t.selectedYear, t.selectedMonth + 1, t])
        },
        _getNumberOfMonths: function(t) {
            var e = this._get(t, "numberOfMonths");
            return null == e ? [1, 1] : "number" == typeof e ? [1, e] : e
        },
        _getMinMaxDate: function(t, e) {
            return this._determineDate(t, this._get(t, e + "Date"), null)
        },
        _getDaysInMonth: function(t, e) {
            return 32 - this._daylightSavingAdjust(new Date(t, e, 32)).getDate()
        },
        _getFirstDayOfMonth: function(t, e) {
            return new Date(t, e, 1).getDay()
        },
        _canAdjustMonth: function(t, e, i, s) {
            var n = this._getNumberOfMonths(t),
                o = this._daylightSavingAdjust(new Date(i, s + (0 > e ? e : n[0] * n[1]), 1));
            return 0 > e && o.setDate(this._getDaysInMonth(o.getFullYear(), o.getMonth())), this._isInRange(t, o)
        },
        _isInRange: function(t, e) {
            var i, s, n = this._getMinMaxDate(t, "min"),
                o = this._getMinMaxDate(t, "max"),
                a = null,
                r = null,
                h = this._get(t, "yearRange");
            return h && (i = h.split(":"), s = (new Date).getFullYear(), a = parseInt(i[0], 10), r = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (a += s), i[1].match(/[+\-].*/) && (r += s)), (!n || e.getTime() >= n.getTime()) && (!o || e.getTime() <= o.getTime()) && (!a || e.getFullYear() >= a) && (!r || e.getFullYear() <= r)
        },
        _getFormatConfig: function(t) {
            var e = this._get(t, "shortYearCutoff");
            return e = "string" != typeof e ? e : (new Date).getFullYear() % 100 + parseInt(e, 10), {
                shortYearCutoff: e,
                dayNamesShort: this._get(t, "dayNamesShort"),
                dayNames: this._get(t, "dayNames"),
                monthNamesShort: this._get(t, "monthNamesShort"),
                monthNames: this._get(t, "monthNames")
            }
        },
        _formatDate: function(t, e, i, s) {
            e || (t.currentDay = t.selectedDay, t.currentMonth = t.selectedMonth, t.currentYear = t.selectedYear), t.selectedTime && (t.currentHours = t.selectedHours = Math.floor(parseInt(t.selectedTime) / 3600), t.currentMinutes = t.selectedMinutes = (t.selectedTime - 3600 * t.currentHours) / 60);
            var n = e ? "object" == typeof e ? e : new Date(s, i, e, t.currentHours, t.currentMinutes) : new Date(t.currentYear, t.currentMonth, t.currentDay, t.currentHours, t.currentMinutes);
            return this.formatDate(this._get(t, "dateFormat"), n, this._getFormatConfig(t))
        }
    }), t.fn.datepicker = function(e) {
        if (!this.length) return this;
        t.datepicker.initialized || (t(document).mousedown(t.datepicker._checkExternalClick).find(document.body).append(t.datepicker.dpDiv), t.datepicker.initialized = !0), 0 === t("#" + t.datepicker._mainDivId).length && t("body").append(t.datepicker.dpDiv);
        var i = Array.prototype.slice.call(arguments, 1);
        if ("string" == typeof e && ("isDisabled" === e || "getDate" === e || "widget" === e)) return t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i));
        if ("option" === e && 2 === arguments.length && "string" == typeof arguments[1]) return t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i));
        var s = e;
        return this.each(function() {
            if ("string" == typeof s) t.datepicker["_" + s + "Datepicker"].apply(t.datepicker, [this].concat(i));
            else {
                s || (s = {});
                var e = t.extend(e, s, t(this).data("options"));
                try {
                    e.minDate = new Date(e.minDate)
                } catch (n) {}
                try {
                    e.maxDate = new Date(e.maxDate)
                } catch (n) {}
                try {
                    e.defaultDate = new Date(e.defaultDate)
                } catch (n) {}
                t.datepicker._attachDatepicker(this, e)
            }
        })
    }, t.datepicker = new n, t.datepicker.initialized = !1, t.datepicker.uuid = (new Date).getTime(), t.datepicker.version = "1.11.0";
    t.datepicker;
    t.widget("ui.draggable", t.ui.mouse, {
        version: "1.11.0",
        widgetEventPrefix: "drag",
        options: {
            addClasses: !0,
            appendTo: "parent",
            axis: !1,
            connectToSortable: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            iframeFix: !1,
            opacity: !1,
            refreshPositions: !1,
            revert: !1,
            revertDuration: 500,
            scope: "default",
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            snap: !1,
            snapMode: "both",
            snapTolerance: 20,
            stack: !1,
            zIndex: !1,
            drag: null,
            start: null,
            stop: null
        },
        _create: function() {
            "original" !== this.options.helper || /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._setHandleClassName(), this._mouseInit()
        },
        _setOption: function(t, e) {
            this._super(t, e), "handle" === t && this._setHandleClassName()
        },
        _destroy: function() {
            return (this.helper || this.element).is(".ui-draggable-dragging") ? void(this.destroyOnClear = !0) : (this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._removeHandleClassName(), void this._mouseDestroy())
        },
        _mouseCapture: function(e) {
            var i = this.document[0],
                s = this.options;
            try {
                i.activeElement && "body" !== i.activeElement.nodeName.toLowerCase() && t(i.activeElement).blur()
            } catch (n) {}
            return this.helper || s.disabled || t(e.target).closest(".ui-resizable-handle").length > 0 ? !1 : (this.handle = this._getHandle(e), this.handle ? (t(s.iframeFix === !0 ? "iframe" : s.iframeFix).each(function() {
                t("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({
                    width: this.offsetWidth + "px",
                    height: this.offsetHeight + "px",
                    position: "absolute",
                    opacity: "0.001",
                    zIndex: 1e3
                }).css(t(this).offset()).appendTo("body")
            }), !0) : !1)
        },
        _mouseStart: function(e) {
            var i = this.options;
            return this.helper = this._createHelper(e), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), t.ui.ddmanager && (t.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(), this.offsetParent = this.helper.offsetParent(), this.offsetParentCssPosition = this.offsetParent.css("position"), this.offset = this.positionAbs = this.element.offset(), this.offset = {
                top: this.offset.top - this.margins.top,
                left: this.offset.left - this.margins.left
            }, this.offset.scroll = !1, t.extend(this.offset, {
                click: {
                    left: e.pageX - this.offset.left,
                    top: e.pageY - this.offset.top
                },
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }), this.originalPosition = this.position = this._generatePosition(e, !1), this.originalPageX = e.pageX, this.originalPageY = e.pageY, i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt), this._setContainment(), this._trigger("start", e) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), t.ui.ddmanager && !i.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this._mouseDrag(e, !0), t.ui.ddmanager && t.ui.ddmanager.dragStart(this, e), !0)
        },
        _mouseDrag: function(e, i) {
            if ("fixed" === this.offsetParentCssPosition && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(e, !0), this.positionAbs = this._convertPositionTo("absolute"), !i) {
                var s = this._uiHash();
                if (this._trigger("drag", e, s) === !1) return this._mouseUp({}), !1;
                this.position = s.position
            }
            return this.helper[0].style.left = this.position.left + "px", this.helper[0].style.top = this.position.top + "px", t.ui.ddmanager && t.ui.ddmanager.drag(this, e), !1
        },
        _mouseStop: function(e) {
            var i = this,
                s = !1;
            return t.ui.ddmanager && !this.options.dropBehaviour && (s = t.ui.ddmanager.drop(this, e)), this.dropped && (s = this.dropped, this.dropped = !1), "invalid" === this.options.revert && !s || "valid" === this.options.revert && s || this.options.revert === !0 || t.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? t(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() {
                i._trigger("stop", e) !== !1 && i._clear()
            }) : this._trigger("stop", e) !== !1 && this._clear(), !1
        },
        _mouseUp: function(e) {
            return t("div.ui-draggable-iframeFix").each(function() {
                this.parentNode.removeChild(this)
            }), t.ui.ddmanager && t.ui.ddmanager.dragStop(this, e), this.element.focus(), t.ui.mouse.prototype._mouseUp.call(this, e)
        },
        cancel: function() {
            return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this
        },
        _getHandle: function(e) {
            return this.options.handle ? !!t(e.target).closest(this.element.find(this.options.handle)).length : !0
        },
        _setHandleClassName: function() {
            this._removeHandleClassName(), t(this.options.handle || this.element).addClass("ui-draggable-handle")
        },
        _removeHandleClassName: function() {
            this.element.find(".ui-draggable-handle").addBack().removeClass("ui-draggable-handle")
        },
        _createHelper: function(e) {
            var i = this.options,
                s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
            return s.parents("body").length || s.appendTo("parent" === i.appendTo ? this.element[0].parentNode : i.appendTo), s[0] === this.element[0] || /(fixed|absolute)/.test(s.css("position")) || s.css("position", "absolute"), s
        },
        _adjustOffsetFromHelper: function(e) {
            "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
        },
        _isRootNode: function(t) {
            return /(html|body)/i.test(t.tagName) || t === this.document[0]
        },
        _getParentOffset: function() {
            var e = this.offsetParent.offset(),
                i = this.document[0];
            return "absolute" === this.cssPosition && this.scrollParent[0] !== i && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), this._isRootNode(this.offsetParent[0]) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function() {
            if ("relative" !== this.cssPosition) return {
                top: 0,
                left: 0
            };
            var t = this.element.position(),
                e = this._isRootNode(this.scrollParent[0]);
            return {
                top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + (e ? 0 : this.scrollParent.scrollTop()),
                left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + (e ? 0 : this.scrollParent.scrollLeft())
            }
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.element.css("marginLeft"), 10) || 0,
                top: parseInt(this.element.css("marginTop"), 10) || 0,
                right: parseInt(this.element.css("marginRight"), 10) || 0,
                bottom: parseInt(this.element.css("marginBottom"), 10) || 0
            }
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function() {
            var e, i, s, n = this.options,
                o = this.document[0];
            return this.relative_container = null, n.containment ? "window" === n.containment ? void(this.containment = [t(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, t(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, t(window).scrollLeft() + t(window).width() - this.helperProportions.width - this.margins.left, t(window).scrollTop() + (t(window).height() || o.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : "document" === n.containment ? void(this.containment = [0, 0, t(o).width() - this.helperProportions.width - this.margins.left, (t(o).height() || o.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : n.containment.constructor === Array ? void(this.containment = n.containment) : ("parent" === n.containment && (n.containment = this.helper[0].parentNode), i = t(n.containment), s = i[0], void(s && (e = "hidden" !== i.css("overflow"), this.containment = [(parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (e ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relative_container = i))) : void(this.containment = null)
        },
        _convertPositionTo: function(t, e) {
            e || (e = this.position);
            var i = "absolute" === t ? 1 : -1,
                s = this._isRootNode(this.scrollParent[0]);
            return {
                top: e.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.offset.scroll.top : s ? 0 : this.offset.scroll.top) * i,
                left: e.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.offset.scroll.left : s ? 0 : this.offset.scroll.left) * i
            }
        },
        _generatePosition: function(t, e) {
            var i, s, n, o, a = this.options,
                r = this._isRootNode(this.scrollParent[0]),
                h = t.pageX,
                l = t.pageY;
            return r && this.offset.scroll || (this.offset.scroll = {
                top: this.scrollParent.scrollTop(),
                left: this.scrollParent.scrollLeft()
            }), e && (this.containment && (this.relative_container ? (s = this.relative_container.offset(), i = [this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top]) : i = this.containment, t.pageX - this.offset.click.left < i[0] && (h = i[0] + this.offset.click.left), t.pageY - this.offset.click.top < i[1] && (l = i[1] + this.offset.click.top), t.pageX - this.offset.click.left > i[2] && (h = i[2] + this.offset.click.left), t.pageY - this.offset.click.top > i[3] && (l = i[3] + this.offset.click.top)), a.grid && (n = a.grid[1] ? this.originalPageY + Math.round((l - this.originalPageY) / a.grid[1]) * a.grid[1] : this.originalPageY, l = i ? n - this.offset.click.top >= i[1] || n - this.offset.click.top > i[3] ? n : n - this.offset.click.top >= i[1] ? n - a.grid[1] : n + a.grid[1] : n, o = a.grid[0] ? this.originalPageX + Math.round((h - this.originalPageX) / a.grid[0]) * a.grid[0] : this.originalPageX, h = i ? o - this.offset.click.left >= i[0] || o - this.offset.click.left > i[2] ? o : o - this.offset.click.left >= i[0] ? o - a.grid[0] : o + a.grid[0] : o), "y" === a.axis && (h = this.originalPageX), "x" === a.axis && (l = this.originalPageY)), {
                top: l - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.offset.scroll.top : r ? 0 : this.offset.scroll.top),
                left: h - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.offset.scroll.left : r ? 0 : this.offset.scroll.left)
            }
        },
        _clear: function() {
            this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1, this.destroyOnClear && this.destroy()
        },
        _trigger: function(e, i, s) {
            return s = s || this._uiHash(), t.ui.plugin.call(this, e, [i, s, this], !0), "drag" === e && (this.positionAbs = this._convertPositionTo("absolute")), t.Widget.prototype._trigger.call(this, e, i, s)
        },
        plugins: {},
        _uiHash: function() {
            return {
                helper: this.helper,
                position: this.position,
                originalPosition: this.originalPosition,
                offset: this.positionAbs
            }
        }
    }), t.ui.plugin.add("draggable", "connectToSortable", {
        start: function(e, i, s) {
            var n = s.options,
                o = t.extend({}, i, {
                    item: s.element
                });
            s.sortables = [], t(n.connectToSortable).each(function() {
                var i = t(this).sortable("instance");
                i && !i.options.disabled && (s.sortables.push({
                    instance: i,
                    shouldRevert: i.options.revert
                }), i.refreshPositions(), i._trigger("activate", e, o))
            })
        },
        stop: function(e, i, s) {
            var n = t.extend({}, i, {
                item: s.element
            });
            t.each(s.sortables, function() {
                this.instance.isOver ? (this.instance.isOver = 0, s.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = this.shouldRevert), this.instance._mouseStop(e), this.instance.options.helper = this.instance.options._helper, "original" === s.options.helper && this.instance.currentItem.css({
                    top: "auto",
                    left: "auto"
                })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", e, n))
            })
        },
        drag: function(e, i, s) {
            var n = this;
            t.each(s.sortables, function() {
                var o = !1,
                    a = this;
                this.instance.positionAbs = s.positionAbs, this.instance.helperProportions = s.helperProportions, this.instance.offset.click = s.offset.click, this.instance._intersectsWith(this.instance.containerCache) && (o = !0, t.each(s.sortables, function() {
                    return this.instance.positionAbs = s.positionAbs, this.instance.helperProportions = s.helperProportions, this.instance.offset.click = s.offset.click, this !== a && this.instance._intersectsWith(this.instance.containerCache) && t.contains(a.instance.element[0], this.instance.element[0]) && (o = !1), o
                })), o ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = t(n).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", !0), this.instance.options._helper = this.instance.options.helper, this.instance.options.helper = function() {
                    return i.helper[0]
                }, e.target = this.instance.currentItem[0], this.instance._mouseCapture(e, !0), this.instance._mouseStart(e, !0, !0), this.instance.offset.click.top = s.offset.click.top, this.instance.offset.click.left = s.offset.click.left, this.instance.offset.parent.left -= s.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= s.offset.parent.top - this.instance.offset.parent.top, s._trigger("toSortable", e), s.dropped = this.instance.element, s.currentItem = s.element, this.instance.fromOutside = s), this.instance.currentItem && this.instance._mouseDrag(e)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", e, this.instance._uiHash(this.instance)), this.instance._mouseStop(e, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(), s._trigger("fromSortable", e), s.dropped = !1)
            })
        }
    }), t.ui.plugin.add("draggable", "cursor", {
        start: function(e, i, s) {
            var n = t("body"),
                o = s.options;
            n.css("cursor") && (o._cursor = n.css("cursor")), n.css("cursor", o.cursor)
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._cursor && t("body").css("cursor", n._cursor)
        }
    }), t.ui.plugin.add("draggable", "opacity", {
        start: function(e, i, s) {
            var n = t(i.helper),
                o = s.options;
            n.css("opacity") && (o._opacity = n.css("opacity")), n.css("opacity", o.opacity)
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._opacity && t(i.helper).css("opacity", n._opacity)
        }
    }), t.ui.plugin.add("draggable", "scroll", {
        start: function(t, e, i) {
            i.scrollParent[0] !== i.document[0] && "HTML" !== i.scrollParent[0].tagName && (i.overflowOffset = i.scrollParent.offset())
        },
        drag: function(e, i, s) {
            var n = s.options,
                o = !1,
                a = s.document[0];
            s.scrollParent[0] !== a && "HTML" !== s.scrollParent[0].tagName ? (n.axis && "x" === n.axis || (s.overflowOffset.top + s.scrollParent[0].offsetHeight - e.pageY < n.scrollSensitivity ? s.scrollParent[0].scrollTop = o = s.scrollParent[0].scrollTop + n.scrollSpeed : e.pageY - s.overflowOffset.top < n.scrollSensitivity && (s.scrollParent[0].scrollTop = o = s.scrollParent[0].scrollTop - n.scrollSpeed)), n.axis && "y" === n.axis || (s.overflowOffset.left + s.scrollParent[0].offsetWidth - e.pageX < n.scrollSensitivity ? s.scrollParent[0].scrollLeft = o = s.scrollParent[0].scrollLeft + n.scrollSpeed : e.pageX - s.overflowOffset.left < n.scrollSensitivity && (s.scrollParent[0].scrollLeft = o = s.scrollParent[0].scrollLeft - n.scrollSpeed))) : (n.axis && "x" === n.axis || (e.pageY - t(a).scrollTop() < n.scrollSensitivity ? o = t(a).scrollTop(t(a).scrollTop() - n.scrollSpeed) : t(window).height() - (e.pageY - t(a).scrollTop()) < n.scrollSensitivity && (o = t(a).scrollTop(t(a).scrollTop() + n.scrollSpeed))), n.axis && "y" === n.axis || (e.pageX - t(a).scrollLeft() < n.scrollSensitivity ? o = t(a).scrollLeft(t(a).scrollLeft() - n.scrollSpeed) : t(window).width() - (e.pageX - t(a).scrollLeft()) < n.scrollSensitivity && (o = t(a).scrollLeft(t(a).scrollLeft() + n.scrollSpeed)))), o !== !1 && t.ui.ddmanager && !n.dropBehaviour && t.ui.ddmanager.prepareOffsets(s, e)
        }
    }), t.ui.plugin.add("draggable", "snap", {
        start: function(e, i, s) {
            var n = s.options;
            s.snapElements = [], t(n.snap.constructor !== String ? n.snap.items || ":data(ui-draggable)" : n.snap).each(function() {
                var e = t(this),
                    i = e.offset();
                this !== s.element[0] && s.snapElements.push({
                    item: this,
                    width: e.outerWidth(),
                    height: e.outerHeight(),
                    top: i.top,
                    left: i.left
                })
            })
        },
        drag: function(e, i, s) {
            var n, o, a, r, h, l, c, u, d, p, f = s.options,
                m = f.snapTolerance,
                g = i.offset.left,
                v = g + s.helperProportions.width,
                _ = i.offset.top,
                b = _ + s.helperProportions.height;
            for (d = s.snapElements.length - 1; d >= 0; d--) h = s.snapElements[d].left, l = h + s.snapElements[d].width, c = s.snapElements[d].top, u = c + s.snapElements[d].height, h - m > v || g > l + m || c - m > b || _ > u + m || !t.contains(s.snapElements[d].item.ownerDocument, s.snapElements[d].item) ? (s.snapElements[d].snapping && s.options.snap.release && s.options.snap.release.call(s.element, e, t.extend(s._uiHash(), {
                snapItem: s.snapElements[d].item
            })), s.snapElements[d].snapping = !1) : ("inner" !== f.snapMode && (n = Math.abs(c - b) <= m, o = Math.abs(u - _) <= m, a = Math.abs(h - v) <= m, r = Math.abs(l - g) <= m, n && (i.position.top = s._convertPositionTo("relative", {
                top: c - s.helperProportions.height,
                left: 0
            }).top - s.margins.top), o && (i.position.top = s._convertPositionTo("relative", {
                top: u,
                left: 0
            }).top - s.margins.top), a && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: h - s.helperProportions.width
            }).left - s.margins.left), r && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: l
            }).left - s.margins.left)), p = n || o || a || r, "outer" !== f.snapMode && (n = Math.abs(c - _) <= m, o = Math.abs(u - b) <= m, a = Math.abs(h - g) <= m, r = Math.abs(l - v) <= m, n && (i.position.top = s._convertPositionTo("relative", {
                top: c,
                left: 0
            }).top - s.margins.top), o && (i.position.top = s._convertPositionTo("relative", {
                top: u - s.helperProportions.height,
                left: 0
            }).top - s.margins.top), a && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: h
            }).left - s.margins.left), r && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: l - s.helperProportions.width
            }).left - s.margins.left)), !s.snapElements[d].snapping && (n || o || a || r || p) && s.options.snap.snap && s.options.snap.snap.call(s.element, e, t.extend(s._uiHash(), {
                snapItem: s.snapElements[d].item
            })), s.snapElements[d].snapping = n || o || a || r || p)
        }
    }), t.ui.plugin.add("draggable", "stack", {
        start: function(e, i, s) {
            var n, o = s.options,
                a = t.makeArray(t(o.stack)).sort(function(e, i) {
                    return (parseInt(t(e).css("zIndex"), 10) || 0) - (parseInt(t(i).css("zIndex"), 10) || 0)
                });
            a.length && (n = parseInt(t(a[0]).css("zIndex"), 10) || 0, t(a).each(function(e) {
                t(this).css("zIndex", n + e)
            }), this.css("zIndex", n + a.length))
        }
    }), t.ui.plugin.add("draggable", "zIndex", {
        start: function(e, i, s) {
            var n = t(i.helper),
                o = s.options;
            n.css("zIndex") && (o._zIndex = n.css("zIndex")), n.css("zIndex", o.zIndex)
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._zIndex && t(i.helper).css("zIndex", n._zIndex)
        }
    });
    t.ui.draggable;
    t.widget("ui.resizable", t.ui.mouse, {
        version: "1.11.0",
        widgetEventPrefix: "resize",
        options: {
            alsoResize: !1,
            animate: !1,
            animateDuration: "slow",
            animateEasing: "swing",
            aspectRatio: !1,
            autoHide: !1,
            containment: !1,
            ghost: !1,
            grid: !1,
            handles: "e,s,se",
            helper: !1,
            maxHeight: null,
            maxWidth: null,
            minHeight: 10,
            minWidth: 10,
            zIndex: 90,
            resize: null,
            start: null,
            stop: null
        },
        _num: function(t) {
            return parseInt(t, 10) || 0
        },
        _isNumber: function(t) {
            return !isNaN(parseInt(t, 10))
        },
        _hasScroll: function(e, i) {
            if ("hidden" === t(e).css("overflow")) return !1;
            var s = i && "left" === i ? "scrollLeft" : "scrollTop",
                n = !1;
            return e[s] > 0 ? !0 : (e[s] = 1, n = e[s] > 0, e[s] = 0, n)
        },
        _create: function() {
            var e, i, s, n, o, a = this,
                r = this.options;
            if (this.element.addClass("ui-resizable"), t.extend(this, {
                    _aspectRatio: !!r.aspectRatio,
                    aspectRatio: r.aspectRatio,
                    originalElement: this.element,
                    _proportionallyResizeElements: [],
                    _helper: r.helper || r.ghost || r.animate ? r.helper || "ui-resizable-helper" : null
                }), this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i) && (this.element.wrap(t("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                    position: this.element.css("position"),
                    width: this.element.outerWidth(),
                    height: this.element.outerHeight(),
                    top: this.element.css("top"),
                    left: this.element.css("left")
                })), this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance")), this.elementIsWrapper = !0, this.element.css({
                    marginLeft: this.originalElement.css("marginLeft"),
                    marginTop: this.originalElement.css("marginTop"),
                    marginRight: this.originalElement.css("marginRight"),
                    marginBottom: this.originalElement.css("marginBottom")
                }), this.originalElement.css({
                    marginLeft: 0,
                    marginTop: 0,
                    marginRight: 0,
                    marginBottom: 0
                }), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
                    position: "static",
                    zoom: 1,
                    display: "block"
                })), this.originalElement.css({
                    margin: this.originalElement.css("margin")
                }), this._proportionallyResize()), this.handles = r.handles || (t(".ui-resizable-handle", this.element).length ? {
                    n: ".ui-resizable-n",
                    e: ".ui-resizable-e",
                    s: ".ui-resizable-s",
                    w: ".ui-resizable-w",
                    se: ".ui-resizable-se",
                    sw: ".ui-resizable-sw",
                    ne: ".ui-resizable-ne",
                    nw: ".ui-resizable-nw"
                } : "e,s,se"), this.handles.constructor === String)
                for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), e = this.handles.split(","), this.handles = {}, i = 0; i < e.length; i++) s = t.trim(e[i]), o = "ui-resizable-" + s, n = t("<div class='ui-resizable-handle " + o + "'></div>"), n.css({
                    zIndex: r.zIndex
                }), "se" === s && n.addClass("ui-icon ui-icon-gripsmall-diagonal-se"), this.handles[s] = ".ui-resizable-" + s, this.element.append(n);
            this._renderAxis = function(e) {
                var i, s, n, o;
                e = e || this.element;
                for (i in this.handles) this.handles[i].constructor === String && (this.handles[i] = this.element.children(this.handles[i]).first().show()), this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i) && (s = t(this.handles[i], this.element), o = /sw|ne|nw|se|n|s/.test(i) ? s.outerHeight() : s.outerWidth(), n = ["padding", /ne|nw|n/.test(i) ? "Top" : /se|sw|s/.test(i) ? "Bottom" : /^e$/.test(i) ? "Right" : "Left"].join(""), e.css(n, o), this._proportionallyResize()), t(this.handles[i]).length
            }, this._renderAxis(this.element), this._handles = t(".ui-resizable-handle", this.element).disableSelection(), this._handles.mouseover(function() {
                a.resizing || (this.className && (n = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), a.axis = n && n[1] ? n[1] : "se")
            }), r.autoHide && (this._handles.hide(), t(this.element).addClass("ui-resizable-autohide").mouseenter(function() {
                r.disabled || (t(this).removeClass("ui-resizable-autohide"), a._handles.show())
            }).mouseleave(function() {
                r.disabled || a.resizing || (t(this).addClass("ui-resizable-autohide"), a._handles.hide())
            })), this._mouseInit()
        },
        _destroy: function() {
            this._mouseDestroy();
            var e, i = function(e) {
                t(e).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()
            };
            return this.elementIsWrapper && (i(this.element), e = this.element, this.originalElement.css({
                position: e.css("position"),
                width: e.outerWidth(),
                height: e.outerHeight(),
                top: e.css("top"),
                left: e.css("left")
            }).insertAfter(e), e.remove()), this.originalElement.css("resize", this.originalResizeStyle), i(this.originalElement), this
        },
        _mouseCapture: function(e) {
            var i, s, n = !1;
            for (i in this.handles) s = t(this.handles[i])[0], (s === e.target || t.contains(s, e.target)) && (n = !0);
            return !this.options.disabled && n
        },
        _mouseStart: function(e) {
            var i, s, n, o = this.options,
                a = this.element;
            return this.resizing = !0, this._renderProxy(), i = this._num(this.helper.css("left")), s = this._num(this.helper.css("top")), o.containment && (i += t(o.containment).scrollLeft() || 0, s += t(o.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
                left: i,
                top: s
            }, this.size = this._helper ? {
                width: this.helper.width(),
                height: this.helper.height()
            } : {
                width: a.width(),
                height: a.height()
            }, this.originalSize = this._helper ? {
                width: a.outerWidth(),
                height: a.outerHeight()
            } : {
                width: a.width(),
                height: a.height()
            }, this.originalPosition = {
                left: i,
                top: s
            }, this.sizeDiff = {
                width: a.outerWidth() - a.width(),
                height: a.outerHeight() - a.height()
            }, this.originalMousePosition = {
                left: e.pageX,
                top: e.pageY
            }, this.aspectRatio = "number" == typeof o.aspectRatio ? o.aspectRatio : this.originalSize.width / this.originalSize.height || 1, n = t(".ui-resizable-" + this.axis).css("cursor"), t("body").css("cursor", "auto" === n ? this.axis + "-resize" : n), a.addClass("ui-resizable-resizing"), this._propagate("start", e), !0
        },
        _mouseDrag: function(e) {
            var i, s = this.helper,
                n = {},
                o = this.originalMousePosition,
                a = this.axis,
                r = e.pageX - o.left || 0,
                h = e.pageY - o.top || 0,
                l = this._change[a];
            return this.prevPosition = {
                top: this.position.top,
                left: this.position.left
            }, this.prevSize = {
                width: this.size.width,
                height: this.size.height
            }, l ? (i = l.apply(this, [e, r, h]), this._updateVirtualBoundaries(e.shiftKey), (this._aspectRatio || e.shiftKey) && (i = this._updateRatio(i, e)), i = this._respectSize(i, e), this._updateCache(i), this._propagate("resize", e), this.position.top !== this.prevPosition.top && (n.top = this.position.top + "px"), this.position.left !== this.prevPosition.left && (n.left = this.position.left + "px"), this.size.width !== this.prevSize.width && (n.width = this.size.width + "px"), this.size.height !== this.prevSize.height && (n.height = this.size.height + "px"), s.css(n), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), t.isEmptyObject(n) || this._trigger("resize", e, this.ui()), !1) : !1
        },
        _mouseStop: function(e) {
            this.resizing = !1;
            var i, s, n, o, a, r, h, l = this.options,
                c = this;
            return this._helper && (i = this._proportionallyResizeElements, s = i.length && /textarea/i.test(i[0].nodeName), n = s && this._hasScroll(i[0], "left") ? 0 : c.sizeDiff.height, o = s ? 0 : c.sizeDiff.width, a = {
                width: c.helper.width() - o,
                height: c.helper.height() - n
            }, r = parseInt(c.element.css("left"), 10) + (c.position.left - c.originalPosition.left) || null, h = parseInt(c.element.css("top"), 10) + (c.position.top - c.originalPosition.top) || null, l.animate || this.element.css(t.extend(a, {
                top: h,
                left: r
            })), c.helper.height(c.size.height), c.helper.width(c.size.width), this._helper && !l.animate && this._proportionallyResize()), t("body").css("cursor", "auto"), this.element.removeClass("ui-resizable-resizing"), this._propagate("stop", e), this._helper && this.helper.remove(), !1
        },
        _updateVirtualBoundaries: function(t) {
            var e, i, s, n, o, a = this.options;
            o = {
                minWidth: this._isNumber(a.minWidth) ? a.minWidth : 0,
                maxWidth: this._isNumber(a.maxWidth) ? a.maxWidth : 1 / 0,
                minHeight: this._isNumber(a.minHeight) ? a.minHeight : 0,
                maxHeight: this._isNumber(a.maxHeight) ? a.maxHeight : 1 / 0
            }, (this._aspectRatio || t) && (e = o.minHeight * this.aspectRatio, s = o.minWidth / this.aspectRatio, i = o.maxHeight * this.aspectRatio, n = o.maxWidth / this.aspectRatio, e > o.minWidth && (o.minWidth = e), s > o.minHeight && (o.minHeight = s), i < o.maxWidth && (o.maxWidth = i), n < o.maxHeight && (o.maxHeight = n)), this._vBoundaries = o
        },
        _updateCache: function(t) {
            this.offset = this.helper.offset(), this._isNumber(t.left) && (this.position.left = t.left), this._isNumber(t.top) && (this.position.top = t.top), this._isNumber(t.height) && (this.size.height = t.height), this._isNumber(t.width) && (this.size.width = t.width)
        },
        _updateRatio: function(t) {
            var e = this.position,
                i = this.size,
                s = this.axis;
            return this._isNumber(t.height) ? t.width = t.height * this.aspectRatio : this._isNumber(t.width) && (t.height = t.width / this.aspectRatio), "sw" === s && (t.left = e.left + (i.width - t.width), t.top = null), "nw" === s && (t.top = e.top + (i.height - t.height), t.left = e.left + (i.width - t.width)), t
        },
        _respectSize: function(t) {
            var e = this._vBoundaries,
                i = this.axis,
                s = this._isNumber(t.width) && e.maxWidth && e.maxWidth < t.width,
                n = this._isNumber(t.height) && e.maxHeight && e.maxHeight < t.height,
                o = this._isNumber(t.width) && e.minWidth && e.minWidth > t.width,
                a = this._isNumber(t.height) && e.minHeight && e.minHeight > t.height,
                r = this.originalPosition.left + this.originalSize.width,
                h = this.position.top + this.size.height,
                l = /sw|nw|w/.test(i),
                c = /nw|ne|n/.test(i);
            return o && (t.width = e.minWidth), a && (t.height = e.minHeight), s && (t.width = e.maxWidth), n && (t.height = e.maxHeight), o && l && (t.left = r - e.minWidth), s && l && (t.left = r - e.maxWidth), a && c && (t.top = h - e.minHeight), n && c && (t.top = h - e.maxHeight), t.width || t.height || t.left || !t.top ? t.width || t.height || t.top || !t.left || (t.left = null) : t.top = null, t
        },
        _proportionallyResize: function() {
            if (this._proportionallyResizeElements.length) {
                var t, e, i, s, n, o = this.helper || this.element;
                for (t = 0; t < this._proportionallyResizeElements.length; t++) {
                    if (n = this._proportionallyResizeElements[t], !this.borderDif)
                        for (this.borderDif = [], i = [n.css("borderTopWidth"), n.css("borderRightWidth"), n.css("borderBottomWidth"), n.css("borderLeftWidth")], s = [n.css("paddingTop"), n.css("paddingRight"), n.css("paddingBottom"), n.css("paddingLeft")], e = 0; e < i.length; e++) this.borderDif[e] = (parseInt(i[e], 10) || 0) + (parseInt(s[e], 10) || 0);
                    n.css({
                        height: o.height() - this.borderDif[0] - this.borderDif[2] || 0,
                        width: o.width() - this.borderDif[1] - this.borderDif[3] || 0
                    })
                }
            }
        },
        _renderProxy: function() {
            var e = this.element,
                i = this.options;
            this.elementOffset = e.offset(), this._helper ? (this.helper = this.helper || t("<div style='overflow:hidden;'></div>"), this.helper.addClass(this._helper).css({
                width: this.element.outerWidth() - 1,
                height: this.element.outerHeight() - 1,
                position: "absolute",
                left: this.elementOffset.left + "px",
                top: this.elementOffset.top + "px",
                zIndex: ++i.zIndex
            }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element
        },
        _change: {
            e: function(t, e) {
                return {
                    width: this.originalSize.width + e
                }
            },
            w: function(t, e) {
                var i = this.originalSize,
                    s = this.originalPosition;
                return {
                    left: s.left + e,
                    width: i.width - e
                }
            },
            n: function(t, e, i) {
                var s = this.originalSize,
                    n = this.originalPosition;
                return {
                    top: n.top + i,
                    height: s.height - i
                }
            },
            s: function(t, e, i) {
                return {
                    height: this.originalSize.height + i
                }
            },
            se: function(e, i, s) {
                return t.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [e, i, s]))
            },
            sw: function(e, i, s) {
                return t.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [e, i, s]))
            },
            ne: function(e, i, s) {
                return t.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [e, i, s]))
            },
            nw: function(e, i, s) {
                return t.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [e, i, s]))
            }
        },
        _propagate: function(e, i) {
            t.ui.plugin.call(this, e, [i, this.ui()]), "resize" !== e && this._trigger(e, i, this.ui())
        },
        plugins: {},
        ui: function() {
            return {
                originalElement: this.originalElement,
                element: this.element,
                helper: this.helper,
                position: this.position,
                size: this.size,
                originalSize: this.originalSize,
                originalPosition: this.originalPosition,
                prevSize: this.prevSize,
                prevPosition: this.prevPosition
            }
        }
    }), t.ui.plugin.add("resizable", "animate", {
        stop: function(e) {
            var i = t(this).resizable("instance"),
                s = i.options,
                n = i._proportionallyResizeElements,
                o = n.length && /textarea/i.test(n[0].nodeName),
                a = o && i._hasScroll(n[0], "left") ? 0 : i.sizeDiff.height,
                r = o ? 0 : i.sizeDiff.width,
                h = {
                    width: i.size.width - r,
                    height: i.size.height - a
                },
                l = parseInt(i.element.css("left"), 10) + (i.position.left - i.originalPosition.left) || null,
                c = parseInt(i.element.css("top"), 10) + (i.position.top - i.originalPosition.top) || null;
            i.element.animate(t.extend(h, c && l ? {
                top: c,
                left: l
            } : {}), {
                duration: s.animateDuration,
                easing: s.animateEasing,
                step: function() {
                    var s = {
                        width: parseInt(i.element.css("width"), 10),
                        height: parseInt(i.element.css("height"), 10),
                        top: parseInt(i.element.css("top"), 10),
                        left: parseInt(i.element.css("left"), 10)
                    };
                    n && n.length && t(n[0]).css({
                        width: s.width,
                        height: s.height
                    }), i._updateCache(s), i._propagate("resize", e)
                }
            })
        }
    }), t.ui.plugin.add("resizable", "containment", {
        start: function() {
            var e, i, s, n, o, a, r, h = t(this).resizable("instance"),
                l = h.options,
                c = h.element,
                u = l.containment,
                d = u instanceof t ? u.get(0) : /parent/.test(u) ? c.parent().get(0) : u;
            d && (h.containerElement = t(d), /document/.test(u) || u === document ? (h.containerOffset = {
                left: 0,
                top: 0
            }, h.containerPosition = {
                left: 0,
                top: 0
            }, h.parentData = {
                element: t(document),
                left: 0,
                top: 0,
                width: t(document).width(),
                height: t(document).height() || document.body.parentNode.scrollHeight
            }) : (e = t(d), i = [], t(["Top", "Right", "Left", "Bottom"]).each(function(t, s) {
                i[t] = h._num(e.css("padding" + s))
            }), h.containerOffset = e.offset(), h.containerPosition = e.position(), h.containerSize = {
                height: e.innerHeight() - i[3],
                width: e.innerWidth() - i[1]
            }, s = h.containerOffset, n = h.containerSize.height, o = h.containerSize.width, a = h._hasScroll(d, "left") ? d.scrollWidth : o, r = h._hasScroll(d) ? d.scrollHeight : n, h.parentData = {
                element: d,
                left: s.left,
                top: s.top,
                width: a,
                height: r
            }))
        },
        resize: function(e, i) {
            var s, n, o, a, r = t(this).resizable("instance"),
                h = r.options,
                l = r.containerOffset,
                c = r.position,
                u = r._aspectRatio || e.shiftKey,
                d = {
                    top: 0,
                    left: 0
                },
                p = r.containerElement,
                f = !0;
            p[0] !== document && /static/.test(p.css("position")) && (d = l), c.left < (r._helper ? l.left : 0) && (r.size.width = r.size.width + (r._helper ? r.position.left - l.left : r.position.left - d.left), u && (r.size.height = r.size.width / r.aspectRatio, f = !1), r.position.left = h.helper ? l.left : 0), c.top < (r._helper ? l.top : 0) && (r.size.height = r.size.height + (r._helper ? r.position.top - l.top : r.position.top), u && (r.size.width = r.size.height * r.aspectRatio, f = !1), r.position.top = r._helper ? l.top : 0), r.offset.left = r.parentData.left + r.position.left, r.offset.top = r.parentData.top + r.position.top, s = Math.abs((r._helper ? r.offset.left - d.left : r.offset.left - l.left) + r.sizeDiff.width), n = Math.abs((r._helper ? r.offset.top - d.top : r.offset.top - l.top) + r.sizeDiff.height), o = r.containerElement.get(0) === r.element.parent().get(0), a = /relative|absolute/.test(r.containerElement.css("position")), o && a && (s -= Math.abs(r.parentData.left)), s + r.size.width >= r.parentData.width && (r.size.width = r.parentData.width - s, u && (r.size.height = r.size.width / r.aspectRatio, f = !1)), n + r.size.height >= r.parentData.height && (r.size.height = r.parentData.height - n, u && (r.size.width = r.size.height * r.aspectRatio, f = !1)), f || (r.position.left = i.prevPosition.left, r.position.top = i.prevPosition.top, r.size.width = i.prevSize.width, r.size.height = i.prevSize.height)
        },
        stop: function() {
            var e = t(this).resizable("instance"),
                i = e.options,
                s = e.containerOffset,
                n = e.containerPosition,
                o = e.containerElement,
                a = t(e.helper),
                r = a.offset(),
                h = a.outerWidth() - e.sizeDiff.width,
                l = a.outerHeight() - e.sizeDiff.height;
            e._helper && !i.animate && /relative/.test(o.css("position")) && t(this).css({
                left: r.left - n.left - s.left,
                width: h,
                height: l
            }), e._helper && !i.animate && /static/.test(o.css("position")) && t(this).css({
                left: r.left - n.left - s.left,
                width: h,
                height: l
            })
        }
    }), t.ui.plugin.add("resizable", "alsoResize", {
        start: function() {
            var e = t(this).resizable("instance"),
                i = e.options,
                s = function(e) {
                    t(e).each(function() {
                        var e = t(this);
                        e.data("ui-resizable-alsoresize", {
                            width: parseInt(e.width(), 10),
                            height: parseInt(e.height(), 10),
                            left: parseInt(e.css("left"), 10),
                            top: parseInt(e.css("top"), 10)
                        })
                    })
                };
            "object" != typeof i.alsoResize || i.alsoResize.parentNode ? s(i.alsoResize) : i.alsoResize.length ? (i.alsoResize = i.alsoResize[0], s(i.alsoResize)) : t.each(i.alsoResize, function(t) {
                s(t)
            })
        },
        resize: function(e, i) {
            var s = t(this).resizable("instance"),
                n = s.options,
                o = s.originalSize,
                a = s.originalPosition,
                r = {
                    height: s.size.height - o.height || 0,
                    width: s.size.width - o.width || 0,
                    top: s.position.top - a.top || 0,
                    left: s.position.left - a.left || 0
                },
                h = function(e, s) {
                    t(e).each(function() {
                        var e = t(this),
                            n = t(this).data("ui-resizable-alsoresize"),
                            o = {},
                            a = s && s.length ? s : e.parents(i.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
                        t.each(a, function(t, e) {
                            var i = (n[e] || 0) + (r[e] || 0);
                            i && i >= 0 && (o[e] = i || null)
                        }), e.css(o)
                    })
                };
            "object" != typeof n.alsoResize || n.alsoResize.nodeType ? h(n.alsoResize) : t.each(n.alsoResize, function(t, e) {
                h(t, e)
            })
        },
        stop: function() {
            t(this).removeData("resizable-alsoresize")
        }
    }), t.ui.plugin.add("resizable", "ghost", {
        start: function() {
            var e = t(this).resizable("instance"),
                i = e.options,
                s = e.size;
            e.ghost = e.originalElement.clone(), e.ghost.css({
                opacity: .25,
                display: "block",
                position: "relative",
                height: s.height,
                width: s.width,
                margin: 0,
                left: 0,
                top: 0
            }).addClass("ui-resizable-ghost").addClass("string" == typeof i.ghost ? i.ghost : ""), e.ghost.appendTo(e.helper)
        },
        resize: function() {
            var e = t(this).resizable("instance");
            e.ghost && e.ghost.css({
                position: "relative",
                height: e.size.height,
                width: e.size.width
            })
        },
        stop: function() {
            var e = t(this).resizable("instance");
            e.ghost && e.helper && e.helper.get(0).removeChild(e.ghost.get(0))
        }
    }), t.ui.plugin.add("resizable", "grid", {
        resize: function() {
            var e = t(this).resizable("instance"),
                i = e.options,
                s = e.size,
                n = e.originalSize,
                o = e.originalPosition,
                a = e.axis,
                r = "number" == typeof i.grid ? [i.grid, i.grid] : i.grid,
                h = r[0] || 1,
                l = r[1] || 1,
                c = Math.round((s.width - n.width) / h) * h,
                u = Math.round((s.height - n.height) / l) * l,
                d = n.width + c,
                p = n.height + u,
                f = i.maxWidth && i.maxWidth < d,
                m = i.maxHeight && i.maxHeight < p,
                g = i.minWidth && i.minWidth > d,
                v = i.minHeight && i.minHeight > p;
            i.grid = r, g && (d += h), v && (p += l), f && (d -= h), m && (p -= l), /^(se|s|e)$/.test(a) ? (e.size.width = d, e.size.height = p) : /^(ne)$/.test(a) ? (e.size.width = d, e.size.height = p, e.position.top = o.top - u) : /^(sw)$/.test(a) ? (e.size.width = d, e.size.height = p, e.position.left = o.left - c) : (p - l > 0 ? (e.size.height = p, e.position.top = o.top - u) : (e.size.height = l, e.position.top = o.top + n.height - l), d - h > 0 ? (e.size.width = d, e.position.left = o.left - c) : (e.size.width = h, e.position.left = o.left + n.width - h));
        }
    });
    t.ui.resizable, t.widget("ui.dialog", {
        version: "1.11.0",
        options: {
            appendTo: "body",
            autoOpen: !0,
            buttons: [],
            closeOnEscape: !0,
            closeText: "Close",
            dialogClass: "",
            draggable: !0,
            hide: null,
            height: "auto",
            maxHeight: null,
            maxWidth: null,
            minHeight: 150,
            minWidth: 150,
            modal: !1,
            position: {
                my: "center",
                at: "center",
                of: window,
                collision: "fit",
                using: function(e) {
                    var i = t(this).css(e).offset().top;
                    0 > i && t(this).css("top", e.top - i)
                }
            },
            resizable: !0,
            show: null,
            title: null,
            width: 300,
            beforeClose: null,
            close: null,
            drag: null,
            dragStart: null,
            dragStop: null,
            focus: null,
            open: null,
            resize: null,
            resizeStart: null,
            resizeStop: null
        },
        sizeRelatedOptions: {
            buttons: !0,
            height: !0,
            maxHeight: !0,
            maxWidth: !0,
            minHeight: !0,
            minWidth: !0,
            width: !0
        },
        resizableRelatedOptions: {
            maxHeight: !0,
            maxWidth: !0,
            minHeight: !0,
            minWidth: !0
        },
        _create: function() {
            this.originalCss = {
                display: this.element[0].style.display,
                width: this.element[0].style.width,
                minHeight: this.element[0].style.minHeight,
                maxHeight: this.element[0].style.maxHeight,
                height: this.element[0].style.height
            }, this.originalPosition = {
                parent: this.element.parent(),
                index: this.element.parent().children().index(this.element)
            }, this.originalTitle = this.element.attr("title"), this.options.title = this.options.title || this.originalTitle, this._createWrapper(), this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog), this._createTitlebar(), this._createButtonPane(), this.options.draggable && t.fn.draggable && this._makeDraggable(), this.options.resizable && t.fn.resizable && this._makeResizable(), this._isOpen = !1, this._trackFocus()
        },
        _init: function() {
            this.options.autoOpen && this.open()
        },
        _appendTo: function() {
            var e = this.options.appendTo;
            return e && (e.jquery || e.nodeType) ? t(e) : this.document.find(e || "body").eq(0)
        },
        _destroy: function() {
            var t, e = this.originalPosition;
            this._destroyOverlay(), this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(), this.uiDialog.stop(!0, !0).remove(), this.originalTitle && this.element.attr("title", this.originalTitle), t = e.parent.children().eq(e.index), t.length && t[0] !== this.element[0] ? t.before(this.element) : e.parent.append(this.element)
        },
        widget: function() {
            return this.uiDialog
        },
        disable: t.noop,
        enable: t.noop,
        close: function(e) {
            var i, s = this;
            if (this._isOpen && this._trigger("beforeClose", e) !== !1) {
                if (this._isOpen = !1, this._focusedElement = null, this._destroyOverlay(), this._untrackInstance(), !this.opener.filter(":focusable").focus().length) try {
                    i = this.document[0].activeElement, i && "body" !== i.nodeName.toLowerCase() && t(i).blur()
                } catch (n) {}
                this._hide(this.uiDialog, this.options.hide, function() {
                    s._trigger("close", e)
                })
            }
        },
        isOpen: function() {
            return this._isOpen
        },
        moveToTop: function() {
            this._moveToTop()
        },
        _moveToTop: function(e, i) {
            var s = !1,
                n = this.uiDialog.siblings(".ui-front:visible").map(function() {
                    return +t(this).css("z-index")
                }).get(),
                o = Math.max.apply(null, n);
            return o >= +this.uiDialog.css("z-index") && (this.uiDialog.css("z-index", o + 1), s = !0), s && !i && this._trigger("focus", e), s
        },
        open: function() {
            var e = this;
            return this._isOpen ? void(this._moveToTop() && this._focusTabbable()) : (this._isOpen = !0, this.opener = t(this.document[0].activeElement), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this._show(this.uiDialog, this.options.show, function() {
                e._focusTabbable(), e._trigger("focus")
            }), void this._trigger("open"))
        },
        _focusTabbable: function() {
            var t = this._focusedElement;
            t || (t = this.element.find("[autofocus]")), t.length || (t = this.element.find(":tabbable")), t.length || (t = this.uiDialogButtonPane.find(":tabbable")), t.length || (t = this.uiDialogTitlebarClose.filter(":tabbable")), t.length || (t = this.uiDialog), t.eq(0).focus()
        },
        _keepFocus: function(e) {
            function i() {
                var e = this.document[0].activeElement,
                    i = this.uiDialog[0] === e || t.contains(this.uiDialog[0], e);
                i || this._focusTabbable()
            }
            e.preventDefault(), i.call(this), this._delay(i)
        },
        _createWrapper: function() {
            this.uiDialog = t("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " + this.options.dialogClass).hide().attr({
                tabIndex: -1,
                role: "dialog"
            }).appendTo(this._appendTo()), this._on(this.uiDialog, {
                keydown: function(e) {
                    if (this.options.closeOnEscape && !e.isDefaultPrevented() && e.keyCode && e.keyCode === t.ui.keyCode.ESCAPE) return e.preventDefault(), void this.close(e);
                    if (e.keyCode === t.ui.keyCode.TAB && !e.isDefaultPrevented()) {
                        var i = this.uiDialog.find(":tabbable"),
                            s = i.filter(":first"),
                            n = i.filter(":last");
                        e.target !== n[0] && e.target !== this.uiDialog[0] || e.shiftKey ? e.target !== s[0] && e.target !== this.uiDialog[0] || !e.shiftKey || (this._delay(function() {
                            n.focus()
                        }), e.preventDefault()) : (this._delay(function() {
                            s.focus()
                        }), e.preventDefault())
                    }
                },
                mousedown: function(t) {
                    this._moveToTop(t) && this._focusTabbable()
                }
            }), this.element.find("[aria-describedby]").length || this.uiDialog.attr({
                "aria-describedby": this.element.uniqueId().attr("id")
            })
        },
        _createTitlebar: function() {
            var e;
            this.uiDialogTitlebar = t("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog), this._on(this.uiDialogTitlebar, {
                mousedown: function(e) {
                    t(e.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.focus()
                }
            }), this.uiDialogTitlebarClose = t("<button type='button'></button>").button({
                label: this.options.closeText,
                icons: {
                    primary: "ui-icon-closethick"
                },
                text: !1
            }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar), this._on(this.uiDialogTitlebarClose, {
                click: function(t) {
                    t.preventDefault(), this.close(t)
                }
            }), e = t("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar), this._title(e), this.uiDialog.attr({
                "aria-labelledby": e.attr("id")
            })
        },
        _title: function(t) {
            this.options.title || t.html("&#160;"), t.text(this.options.title)
        },
        _createButtonPane: function() {
            this.uiDialogButtonPane = t("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"), this.uiButtonSet = t("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane), this._createButtons()
        },
        _createButtons: function() {
            var e = this,
                i = this.options.buttons;
            return this.uiDialogButtonPane.remove(), this.uiButtonSet.empty(), t.isEmptyObject(i) || t.isArray(i) && !i.length ? void this.uiDialog.removeClass("ui-dialog-buttons") : (t.each(i, function(i, s) {
                var n, o;
                s = t.isFunction(s) ? {
                    click: s,
                    text: i
                } : s, s = t.extend({
                    type: "button"
                }, s), n = s.click, s.click = function() {
                    n.apply(e.element[0], arguments)
                }, o = {
                    icons: s.icons,
                    text: s.showText
                }, delete s.icons, delete s.showText, t("<button></button>", s).button(o).appendTo(e.uiButtonSet)
            }), this.uiDialog.addClass("ui-dialog-buttons"), void this.uiDialogButtonPane.appendTo(this.uiDialog))
        },
        _makeDraggable: function() {
            function e(t) {
                return {
                    position: t.position,
                    offset: t.offset
                }
            }
            var i = this,
                s = this.options;
            this.uiDialog.draggable({
                cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
                handle: ".ui-dialog-titlebar",
                containment: "document",
                start: function(s, n) {
                    t(this).addClass("ui-dialog-dragging"), i._blockFrames(), i._trigger("dragStart", s, e(n))
                },
                drag: function(t, s) {
                    i._trigger("drag", t, e(s))
                },
                stop: function(n, o) {
                    var a = o.offset.left - i.document.scrollLeft(),
                        r = o.offset.top - i.document.scrollTop();
                    s.position = {
                        my: "left top",
                        at: "left" + (a >= 0 ? "+" : "") + a + " top" + (r >= 0 ? "+" : "") + r,
                        of: i.window
                    }, t(this).removeClass("ui-dialog-dragging"), i._unblockFrames(), i._trigger("dragStop", n, e(o))
                }
            })
        },
        _makeResizable: function() {
            function e(t) {
                return {
                    originalPosition: t.originalPosition,
                    originalSize: t.originalSize,
                    position: t.position,
                    size: t.size
                }
            }
            var i = this,
                s = this.options,
                n = s.resizable,
                o = this.uiDialog.css("position"),
                a = "string" == typeof n ? n : "n,e,s,w,se,sw,ne,nw";
            this.uiDialog.resizable({
                cancel: ".ui-dialog-content",
                containment: "document",
                alsoResize: this.element,
                maxWidth: s.maxWidth,
                maxHeight: s.maxHeight,
                minWidth: s.minWidth,
                minHeight: this._minHeight(),
                handles: a,
                start: function(s, n) {
                    t(this).addClass("ui-dialog-resizing"), i._blockFrames(), i._trigger("resizeStart", s, e(n))
                },
                resize: function(t, s) {
                    i._trigger("resize", t, e(s))
                },
                stop: function(n, o) {
                    var a = i.uiDialog.offset(),
                        r = a.left - i.document.scrollLeft(),
                        h = a.top - i.document.scrollTop();
                    s.height = i.uiDialog.height(), s.width = i.uiDialog.width(), s.position = {
                        my: "left top",
                        at: "left" + (r >= 0 ? "+" : "") + r + " top" + (h >= 0 ? "+" : "") + h,
                        of: i.window
                    }, t(this).removeClass("ui-dialog-resizing"), i._unblockFrames(), i._trigger("resizeStop", n, e(o))
                }
            }).css("position", o)
        },
        _trackFocus: function() {
            this._on(this.widget(), {
                focusin: function(e) {
                    this._untrackInstance(), this._trackingInstances().unshift(this), this._focusedElement = t(e.target)
                }
            })
        },
        _untrackInstance: function() {
            var e = this._trackingInstances(),
                i = t.inArray(this, e); - 1 !== i && e.splice(i, 1)
        },
        _trackingInstances: function() {
            var t = this.document.data("ui-dialog-instances");
            return t || (t = [], this.document.data("ui-dialog-instances", t)), t
        },
        _minHeight: function() {
            var t = this.options;
            return "auto" === t.height ? t.minHeight : Math.min(t.minHeight, t.height)
        },
        _position: function() {
            var t = this.uiDialog.is(":visible");
            t || this.uiDialog.show(), this.uiDialog.position(this.options.position), t || this.uiDialog.hide()
        },
        _setOptions: function(e) {
            var i = this,
                s = !1,
                n = {};
            t.each(e, function(t, e) {
                i._setOption(t, e), t in i.sizeRelatedOptions && (s = !0), t in i.resizableRelatedOptions && (n[t] = e)
            }), s && (this._size(), this._position()), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", n)
        },
        _setOption: function(t, e) {
            var i, s, n = this.uiDialog;
            "dialogClass" === t && n.removeClass(this.options.dialogClass).addClass(e), "disabled" !== t && (this._super(t, e), "appendTo" === t && this.uiDialog.appendTo(this._appendTo()), "buttons" === t && this._createButtons(), "closeText" === t && this.uiDialogTitlebarClose.button({
                label: "" + e
            }), "draggable" === t && (i = n.is(":data(ui-draggable)"), i && !e && n.draggable("destroy"), !i && e && this._makeDraggable()), "position" === t && this._position(), "resizable" === t && (s = n.is(":data(ui-resizable)"), s && !e && n.resizable("destroy"), s && "string" == typeof e && n.resizable("option", "handles", e), s || e === !1 || this._makeResizable()), "title" === t && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))
        },
        _size: function() {
            var t, e, i, s = this.options;
            this.element.show().css({
                width: "auto",
                minHeight: 0,
                maxHeight: "none",
                height: 0
            }), s.minWidth > s.width && (s.width = s.minWidth), t = this.uiDialog.css({
                height: "auto",
                width: s.width
            }).outerHeight(), e = Math.max(0, s.minHeight - t), i = "number" == typeof s.maxHeight ? Math.max(0, s.maxHeight - t) : "none", "auto" === s.height ? this.element.css({
                minHeight: e,
                maxHeight: i,
                height: "auto"
            }) : this.element.height(Math.max(0, s.height - t)), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())
        },
        _blockFrames: function() {
            this.iframeBlocks = this.document.find("iframe").map(function() {
                var e = t(this);
                return t("<div>").css({
                    position: "absolute",
                    width: e.outerWidth(),
                    height: e.outerHeight()
                }).appendTo(e.parent()).offset(e.offset())[0]
            })
        },
        _unblockFrames: function() {
            this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
        },
        _allowInteraction: function(e) {
            return t(e.target).closest(".ui-dialog").length ? !0 : !!t(e.target).closest(".ui-datepicker").length
        },
        _createOverlay: function() {
            if (this.options.modal) {
                var e = !0;
                this._delay(function() {
                    e = !1
                }), this.document.data("ui-dialog-overlays") || this._on(this.document, {
                    focusin: function(t) {
                        e || this._allowInteraction(t) || (t.preventDefault(), this._trackingInstances()[0]._focusTabbable())
                    }
                }), this.overlay = t("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()), this._on(this.overlay, {
                    mousedown: "_keepFocus"
                }), this.document.data("ui-dialog-overlays", (this.document.data("ui-dialog-overlays") || 0) + 1)
            }
        },
        _destroyOverlay: function() {
            if (this.options.modal && this.overlay) {
                var t = this.document.data("ui-dialog-overlays") - 1;
                t ? this.document.data("ui-dialog-overlays", t) : this.document.unbind("focusin").removeData("ui-dialog-overlays"), this.overlay.remove(), this.overlay = null
            }
        }
    });
    t.widget("ui.droppable", {
        version: "1.11.0",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            activeClass: !1,
            addClasses: !0,
            greedy: !1,
            hoverClass: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function() {
            var e, i = this.options,
                s = i.accept;
            this.isover = !1, this.isout = !0, this.accept = t.isFunction(s) ? s : function(t) {
                return t.is(s)
            }, this.proportions = function() {
                return arguments.length ? void(e = arguments[0]) : e ? e : e = {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                }
            }, this._addToManager(i.scope), i.addClasses && this.element.addClass("ui-droppable")
        },
        _addToManager: function(e) {
            t.ui.ddmanager.droppables[e] = t.ui.ddmanager.droppables[e] || [], t.ui.ddmanager.droppables[e].push(this)
        },
        _splice: function(t) {
            for (var e = 0; e < t.length; e++) t[e] === this && t.splice(e, 1)
        },
        _destroy: function() {
            var e = t.ui.ddmanager.droppables[this.options.scope];
            this._splice(e), this.element.removeClass("ui-droppable ui-droppable-disabled")
        },
        _setOption: function(e, i) {
            if ("accept" === e) this.accept = t.isFunction(i) ? i : function(t) {
                return t.is(i)
            };
            else if ("scope" === e) {
                var s = t.ui.ddmanager.droppables[this.options.scope];
                this._splice(s), this._addToManager(i)
            }
            this._super(e, i)
        },
        _activate: function(e) {
            var i = t.ui.ddmanager.current;
            this.options.activeClass && this.element.addClass(this.options.activeClass), i && this._trigger("activate", e, this.ui(i))
        },
        _deactivate: function(e) {
            var i = t.ui.ddmanager.current;
            this.options.activeClass && this.element.removeClass(this.options.activeClass), i && this._trigger("deactivate", e, this.ui(i))
        },
        _over: function(e) {
            var i = t.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", e, this.ui(i)))
        },
        _out: function(e) {
            var i = t.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", e, this.ui(i)))
        },
        _drop: function(e, i) {
            var s = i || t.ui.ddmanager.current,
                n = !1;
            return s && (s.currentItem || s.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
                var e = t(this).droppable("instance");
                return e.options.greedy && !e.options.disabled && e.options.scope === s.options.scope && e.accept.call(e.element[0], s.currentItem || s.element) && t.ui.intersect(s, t.extend(e, {
                    offset: e.element.offset()
                }), e.options.tolerance) ? (n = !0, !1) : void 0
            }), n ? !1 : this.accept.call(this.element[0], s.currentItem || s.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", e, this.ui(s)), this.element) : !1) : !1
        },
        ui: function(t) {
            return {
                draggable: t.currentItem || t.element,
                helper: t.helper,
                position: t.position,
                offset: t.positionAbs
            }
        }
    }), t.ui.intersect = function() {
        function t(t, e, i) {
            return t >= e && e + i > t
        }
        return function(e, i, s) {
            if (!i.offset) return !1;
            var n, o, a = (e.positionAbs || e.position.absolute).left,
                r = (e.positionAbs || e.position.absolute).top,
                h = a + e.helperProportions.width,
                l = r + e.helperProportions.height,
                c = i.offset.left,
                u = i.offset.top,
                d = c + i.proportions().width,
                p = u + i.proportions().height;
            switch (s) {
                case "fit":
                    return a >= c && d >= h && r >= u && p >= l;
                case "intersect":
                    return c < a + e.helperProportions.width / 2 && h - e.helperProportions.width / 2 < d && u < r + e.helperProportions.height / 2 && l - e.helperProportions.height / 2 < p;
                case "pointer":
                    return n = (e.positionAbs || e.position.absolute).left + (e.clickOffset || e.offset.click).left, o = (e.positionAbs || e.position.absolute).top + (e.clickOffset || e.offset.click).top, t(o, u, i.proportions().height) && t(n, c, i.proportions().width);
                case "touch":
                    return (r >= u && p >= r || l >= u && p >= l || u > r && l > p) && (a >= c && d >= a || h >= c && d >= h || c > a && h > d);
                default:
                    return !1
            }
        }
    }(), t.ui.ddmanager = {
        current: null,
        droppables: {
            "default": []
        },
        prepareOffsets: function(e, i) {
            var s, n, o = t.ui.ddmanager.droppables[e.options.scope] || [],
                a = i ? i.type : null,
                r = (e.currentItem || e.element).find(":data(ui-droppable)").addBack();
            t: for (s = 0; s < o.length; s++)
                if (!(o[s].options.disabled || e && !o[s].accept.call(o[s].element[0], e.currentItem || e.element))) {
                    for (n = 0; n < r.length; n++)
                        if (r[n] === o[s].element[0]) {
                            o[s].proportions().height = 0;
                            continue t
                        }
                    o[s].visible = "none" !== o[s].element.css("display"), o[s].visible && ("mousedown" === a && o[s]._activate.call(o[s], i), o[s].offset = o[s].element.offset(), o[s].proportions({
                        width: o[s].element[0].offsetWidth,
                        height: o[s].element[0].offsetHeight
                    }))
                }
        },
        drop: function(e, i) {
            var s = !1;
            return t.each((t.ui.ddmanager.droppables[e.options.scope] || []).slice(), function() {
                this.options && (!this.options.disabled && this.visible && t.ui.intersect(e, this, this.options.tolerance) && (s = this._drop.call(this, i) || s), !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, i)))
            }), s
        },
        dragStart: function(e, i) {
            e.element.parentsUntil("body").bind("scroll.droppable", function() {
                e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)
            })
        },
        drag: function(e, i) {
            e.options.refreshPositions && t.ui.ddmanager.prepareOffsets(e, i), t.each(t.ui.ddmanager.droppables[e.options.scope] || [], function() {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var s, n, o, a = t.ui.intersect(e, this, this.options.tolerance),
                        r = !a && this.isover ? "isout" : a && !this.isover ? "isover" : null;
                    r && (this.options.greedy && (n = this.options.scope, o = this.element.parents(":data(ui-droppable)").filter(function() {
                        return t(this).droppable("instance").options.scope === n
                    }), o.length && (s = t(o[0]).droppable("instance"), s.greedyChild = "isover" === r)), s && "isover" === r && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[r] = !0, this["isout" === r ? "isover" : "isout"] = !1, this["isover" === r ? "_over" : "_out"].call(this, i), s && "isout" === r && (s.isout = !1, s.isover = !0, s._over.call(s, i)))
                }
            })
        },
        dragStop: function(e, i) {
            e.element.parentsUntil("body").unbind("scroll.droppable"), e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)
        }
    };
    var v = (t.ui.droppable, "ui-effects-");
    t.effects = {
            effect: {}
        },
        function(t, e) {
            function i(t, e, i) {
                var s = u[e.type] || {};
                return null == t ? i || !e.def ? null : e.def : (t = s.floor ? ~~t : parseFloat(t), isNaN(t) ? e.def : s.mod ? (t + s.mod) % s.mod : 0 > t ? 0 : s.max < t ? s.max : t)
            }

            function s(e) {
                var i = l(),
                    s = i._rgba = [];
                return e = e.toLowerCase(), f(h, function(t, n) {
                    var o, a = n.re.exec(e),
                        r = a && n.parse(a),
                        h = n.space || "rgba";
                    return r ? (o = i[h](r), i[c[h].cache] = o[c[h].cache], s = i._rgba = o._rgba, !1) : void 0
                }), s.length ? ("0,0,0,0" === s.join() && t.extend(s, o.transparent), i) : o[e]
            }

            function n(t, e, i) {
                return i = (i + 1) % 1, 1 > 6 * i ? t + (e - t) * i * 6 : 1 > 2 * i ? e : 2 > 3 * i ? t + (e - t) * (2 / 3 - i) * 6 : t
            }
            var o, a = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
                r = /^([\-+])=\s*(\d+\.?\d*)/,
                h = [{
                    re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                    parse: function(t) {
                        return [t[1], t[2], t[3], t[4]]
                    }
                }, {
                    re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                    parse: function(t) {
                        return [2.55 * t[1], 2.55 * t[2], 2.55 * t[3], t[4]]
                    }
                }, {
                    re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
                    parse: function(t) {
                        return [parseInt(t[1], 16), parseInt(t[2], 16), parseInt(t[3], 16)]
                    }
                }, {
                    re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
                    parse: function(t) {
                        return [parseInt(t[1] + t[1], 16), parseInt(t[2] + t[2], 16), parseInt(t[3] + t[3], 16)]
                    }
                }, {
                    re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                    space: "hsla",
                    parse: function(t) {
                        return [t[1], t[2] / 100, t[3] / 100, t[4]]
                    }
                }],
                l = t.Color = function(e, i, s, n) {
                    return new t.Color.fn.parse(e, i, s, n)
                },
                c = {
                    rgba: {
                        props: {
                            red: {
                                idx: 0,
                                type: "byte"
                            },
                            green: {
                                idx: 1,
                                type: "byte"
                            },
                            blue: {
                                idx: 2,
                                type: "byte"
                            }
                        }
                    },
                    hsla: {
                        props: {
                            hue: {
                                idx: 0,
                                type: "degrees"
                            },
                            saturation: {
                                idx: 1,
                                type: "percent"
                            },
                            lightness: {
                                idx: 2,
                                type: "percent"
                            }
                        }
                    }
                },
                u = {
                    "byte": {
                        floor: !0,
                        max: 255
                    },
                    percent: {
                        max: 1
                    },
                    degrees: {
                        mod: 360,
                        floor: !0
                    }
                },
                d = l.support = {},
                p = t("<p>")[0],
                f = t.each;
            p.style.cssText = "background-color:rgba(1,1,1,.5)", d.rgba = p.style.backgroundColor.indexOf("rgba") > -1, f(c, function(t, e) {
                e.cache = "_" + t, e.props.alpha = {
                    idx: 3,
                    type: "percent",
                    def: 1
                }
            }), l.fn = t.extend(l.prototype, {
                parse: function(n, a, r, h) {
                    if (n === e) return this._rgba = [null, null, null, null], this;
                    (n.jquery || n.nodeType) && (n = t(n).css(a), a = e);
                    var u = this,
                        d = t.type(n),
                        p = this._rgba = [];
                    return a !== e && (n = [n, a, r, h], d = "array"), "string" === d ? this.parse(s(n) || o._default) : "array" === d ? (f(c.rgba.props, function(t, e) {
                        p[e.idx] = i(n[e.idx], e)
                    }), this) : "object" === d ? (n instanceof l ? f(c, function(t, e) {
                        n[e.cache] && (u[e.cache] = n[e.cache].slice())
                    }) : f(c, function(e, s) {
                        var o = s.cache;
                        f(s.props, function(t, e) {
                            if (!u[o] && s.to) {
                                if ("alpha" === t || null == n[t]) return;
                                u[o] = s.to(u._rgba)
                            }
                            u[o][e.idx] = i(n[t], e, !0)
                        }), u[o] && t.inArray(null, u[o].slice(0, 3)) < 0 && (u[o][3] = 1, s.from && (u._rgba = s.from(u[o])))
                    }), this) : void 0
                },
                is: function(t) {
                    var e = l(t),
                        i = !0,
                        s = this;
                    return f(c, function(t, n) {
                        var o, a = e[n.cache];
                        return a && (o = s[n.cache] || n.to && n.to(s._rgba) || [], f(n.props, function(t, e) {
                            return null != a[e.idx] ? i = a[e.idx] === o[e.idx] : void 0
                        })), i
                    }), i
                },
                _space: function() {
                    var t = [],
                        e = this;
                    return f(c, function(i, s) {
                        e[s.cache] && t.push(i)
                    }), t.pop()
                },
                transition: function(t, e) {
                    var s = l(t),
                        n = s._space(),
                        o = c[n],
                        a = 0 === this.alpha() ? l("transparent") : this,
                        r = a[o.cache] || o.to(a._rgba),
                        h = r.slice();
                    return s = s[o.cache], f(o.props, function(t, n) {
                        var o = n.idx,
                            a = r[o],
                            l = s[o],
                            c = u[n.type] || {};
                        null !== l && (null === a ? h[o] = l : (c.mod && (l - a > c.mod / 2 ? a += c.mod : a - l > c.mod / 2 && (a -= c.mod)), h[o] = i((l - a) * e + a, n)))
                    }), this[n](h)
                },
                blend: function(e) {
                    if (1 === this._rgba[3]) return this;
                    var i = this._rgba.slice(),
                        s = i.pop(),
                        n = l(e)._rgba;
                    return l(t.map(i, function(t, e) {
                        return (1 - s) * n[e] + s * t
                    }))
                },
                toRgbaString: function() {
                    var e = "rgba(",
                        i = t.map(this._rgba, function(t, e) {
                            return null == t ? e > 2 ? 1 : 0 : t
                        });
                    return 1 === i[3] && (i.pop(), e = "rgb("), e + i.join() + ")"
                },
                toHslaString: function() {
                    var e = "hsla(",
                        i = t.map(this.hsla(), function(t, e) {
                            return null == t && (t = e > 2 ? 1 : 0), e && 3 > e && (t = Math.round(100 * t) + "%"), t
                        });
                    return 1 === i[3] && (i.pop(), e = "hsl("), e + i.join() + ")"
                },
                toHexString: function(e) {
                    var i = this._rgba.slice(),
                        s = i.pop();
                    return e && i.push(~~(255 * s)), "#" + t.map(i, function(t) {
                        return t = (t || 0).toString(16), 1 === t.length ? "0" + t : t
                    }).join("")
                },
                toString: function() {
                    return 0 === this._rgba[3] ? "transparent" : this.toRgbaString()
                }
            }), l.fn.parse.prototype = l.fn, c.hsla.to = function(t) {
                if (null == t[0] || null == t[1] || null == t[2]) return [null, null, null, t[3]];
                var e, i, s = t[0] / 255,
                    n = t[1] / 255,
                    o = t[2] / 255,
                    a = t[3],
                    r = Math.max(s, n, o),
                    h = Math.min(s, n, o),
                    l = r - h,
                    c = r + h,
                    u = .5 * c;
                return e = h === r ? 0 : s === r ? 60 * (n - o) / l + 360 : n === r ? 60 * (o - s) / l + 120 : 60 * (s - n) / l + 240, i = 0 === l ? 0 : .5 >= u ? l / c : l / (2 - c), [Math.round(e) % 360, i, u, null == a ? 1 : a]
            }, c.hsla.from = function(t) {
                if (null == t[0] || null == t[1] || null == t[2]) return [null, null, null, t[3]];
                var e = t[0] / 360,
                    i = t[1],
                    s = t[2],
                    o = t[3],
                    a = .5 >= s ? s * (1 + i) : s + i - s * i,
                    r = 2 * s - a;
                return [Math.round(255 * n(r, a, e + 1 / 3)), Math.round(255 * n(r, a, e)), Math.round(255 * n(r, a, e - 1 / 3)), o]
            }, f(c, function(s, n) {
                var o = n.props,
                    a = n.cache,
                    h = n.to,
                    c = n.from;
                l.fn[s] = function(s) {
                    if (h && !this[a] && (this[a] = h(this._rgba)), s === e) return this[a].slice();
                    var n, r = t.type(s),
                        u = "array" === r || "object" === r ? s : arguments,
                        d = this[a].slice();
                    return f(o, function(t, e) {
                        var s = u["object" === r ? t : e.idx];
                        null == s && (s = d[e.idx]), d[e.idx] = i(s, e)
                    }), c ? (n = l(c(d)), n[a] = d, n) : l(d)
                }, f(o, function(e, i) {
                    l.fn[e] || (l.fn[e] = function(n) {
                        var o, a = t.type(n),
                            h = "alpha" === e ? this._hsla ? "hsla" : "rgba" : s,
                            l = this[h](),
                            c = l[i.idx];
                        return "undefined" === a ? c : ("function" === a && (n = n.call(this, c), a = t.type(n)), null == n && i.empty ? this : ("string" === a && (o = r.exec(n), o && (n = c + parseFloat(o[2]) * ("+" === o[1] ? 1 : -1))), l[i.idx] = n, this[h](l)))
                    })
                })
            }), l.hook = function(e) {
                var i = e.split(" ");
                f(i, function(e, i) {
                    t.cssHooks[i] = {
                        set: function(e, n) {
                            var o, a, r = "";
                            if ("transparent" !== n && ("string" !== t.type(n) || (o = s(n)))) {
                                if (n = l(o || n), !d.rgba && 1 !== n._rgba[3]) {
                                    for (a = "backgroundColor" === i ? e.parentNode : e;
                                        ("" === r || "transparent" === r) && a && a.style;) try {
                                        r = t.css(a, "backgroundColor"), a = a.parentNode
                                    } catch (h) {}
                                    n = n.blend(r && "transparent" !== r ? r : "_default")
                                }
                                n = n.toRgbaString()
                            }
                            try {
                                e.style[i] = n
                            } catch (h) {}
                        }
                    }, t.fx.step[i] = function(e) {
                        e.colorInit || (e.start = l(e.elem, i), e.end = l(e.end), e.colorInit = !0), t.cssHooks[i].set(e.elem, e.start.transition(e.end, e.pos))
                    }
                })
            }, l.hook(a), t.cssHooks.borderColor = {
                expand: function(t) {
                    var e = {};
                    return f(["Top", "Right", "Bottom", "Left"], function(i, s) {
                        e["border" + s + "Color"] = t
                    }), e
                }
            }, o = t.Color.names = {
                aqua: "#00ffff",
                black: "#000000",
                blue: "#0000ff",
                fuchsia: "#ff00ff",
                gray: "#808080",
                green: "#008000",
                lime: "#00ff00",
                maroon: "#800000",
                navy: "#000080",
                olive: "#808000",
                purple: "#800080",
                red: "#ff0000",
                silver: "#c0c0c0",
                teal: "#008080",
                white: "#ffffff",
                yellow: "#ffff00",
                transparent: [null, null, null, 0],
                _default: "#ffffff"
            }
        }(jQuery),
        function() {
            function e(e) {
                var i, s, n = e.ownerDocument.defaultView ? e.ownerDocument.defaultView.getComputedStyle(e, null) : e.currentStyle,
                    o = {};
                if (n && n.length && n[0] && n[n[0]])
                    for (s = n.length; s--;) i = n[s], "string" == typeof n[i] && (o[t.camelCase(i)] = n[i]);
                else
                    for (i in n) "string" == typeof n[i] && (o[i] = n[i]);
                return o
            }

            function i(e, i) {
                var s, o, a = {};
                for (s in i) o = i[s], e[s] !== o && (n[s] || (t.fx.step[s] || !isNaN(parseFloat(o))) && (a[s] = o));
                return a
            }
            var s = ["add", "remove", "toggle"],
                n = {
                    border: 1,
                    borderBottom: 1,
                    borderColor: 1,
                    borderLeft: 1,
                    borderRight: 1,
                    borderTop: 1,
                    borderWidth: 1,
                    margin: 1,
                    padding: 1
                };
            t.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function(e, i) {
                t.fx.step[i] = function(t) {
                    ("none" !== t.end && !t.setAttr || 1 === t.pos && !t.setAttr) && (jQuery.style(t.elem, i, t.end), t.setAttr = !0)
                }
            }), t.fn.addBack || (t.fn.addBack = function(t) {
                return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
            }), t.effects.animateClass = function(n, o, a, r) {
                var h = t.speed(o, a, r);
                return this.queue(function() {
                    var o, a = t(this),
                        r = a.attr("class") || "",
                        l = h.children ? a.find("*").addBack() : a;
                    l = l.map(function() {
                        var i = t(this);
                        return {
                            el: i,
                            start: e(this)
                        }
                    }), o = function() {
                        t.each(s, function(t, e) {
                            n[e] && a[e + "Class"](n[e])
                        })
                    }, o(), l = l.map(function() {
                        return this.end = e(this.el[0]), this.diff = i(this.start, this.end), this
                    }), a.attr("class", r), l = l.map(function() {
                        var e = this,
                            i = t.Deferred(),
                            s = t.extend({}, h, {
                                queue: !1,
                                complete: function() {
                                    i.resolve(e)
                                }
                            });
                        return this.el.animate(this.diff, s), i.promise()
                    }), t.when.apply(t, l.get()).done(function() {
                        o(), t.each(arguments, function() {
                            var e = this.el;
                            t.each(this.diff, function(t) {
                                e.css(t, "")
                            })
                        }), h.complete.call(a[0])
                    })
                })
            }, t.fn.extend({
                addClass: function(e) {
                    return function(i, s, n, o) {
                        return s ? t.effects.animateClass.call(this, {
                            add: i
                        }, s, n, o) : e.apply(this, arguments)
                    }
                }(t.fn.addClass),
                removeClass: function(e) {
                    return function(i, s, n, o) {
                        return arguments.length > 1 ? t.effects.animateClass.call(this, {
                            remove: i
                        }, s, n, o) : e.apply(this, arguments)
                    }
                }(t.fn.removeClass),
                toggleClass: function(e) {
                    return function(i, s, n, o, a) {
                        return "boolean" == typeof s || void 0 === s ? n ? t.effects.animateClass.call(this, s ? {
                            add: i
                        } : {
                            remove: i
                        }, n, o, a) : e.apply(this, arguments) : t.effects.animateClass.call(this, {
                            toggle: i
                        }, s, n, o)
                    }
                }(t.fn.toggleClass),
                switchClass: function(e, i, s, n, o) {
                    return t.effects.animateClass.call(this, {
                        add: i,
                        remove: e
                    }, s, n, o)
                }
            })
        }(),
        function() {
            function e(e, i, s, n) {
                return t.isPlainObject(e) && (i = e, e = e.effect), e = {
                    effect: e
                }, null == i && (i = {}), t.isFunction(i) && (n = i, s = null, i = {}), ("number" == typeof i || t.fx.speeds[i]) && (n = s, s = i, i = {}), t.isFunction(s) && (n = s, s = null), i && t.extend(e, i), s = s || i.duration, e.duration = t.fx.off ? 0 : "number" == typeof s ? s : s in t.fx.speeds ? t.fx.speeds[s] : t.fx.speeds._default, e.complete = n || i.complete, e
            }

            function i(e) {
                return !e || "number" == typeof e || t.fx.speeds[e] ? !0 : "string" != typeof e || t.effects.effect[e] ? t.isFunction(e) ? !0 : "object" != typeof e || e.effect ? !1 : !0 : !0
            }
            t.extend(t.effects, {
                version: "1.11.0",
                save: function(t, e) {
                    for (var i = 0; i < e.length; i++) null !== e[i] && t.data(v + e[i], t[0].style[e[i]])
                },
                restore: function(t, e) {
                    var i, s;
                    for (s = 0; s < e.length; s++) null !== e[s] && (i = t.data(v + e[s]), void 0 === i && (i = ""), t.css(e[s], i))
                },
                setMode: function(t, e) {
                    return "toggle" === e && (e = t.is(":hidden") ? "show" : "hide"), e
                },
                getBaseline: function(t, e) {
                    var i, s;
                    switch (t[0]) {
                        case "top":
                            i = 0;
                            break;
                        case "middle":
                            i = .5;
                            break;
                        case "bottom":
                            i = 1;
                            break;
                        default:
                            i = t[0] / e.height
                    }
                    switch (t[1]) {
                        case "left":
                            s = 0;
                            break;
                        case "center":
                            s = .5;
                            break;
                        case "right":
                            s = 1;
                            break;
                        default:
                            s = t[1] / e.width
                    }
                    return {
                        x: s,
                        y: i
                    }
                },
                createWrapper: function(e) {
                    if (e.parent().is(".ui-effects-wrapper")) return e.parent();
                    var i = {
                            width: e.outerWidth(!0),
                            height: e.outerHeight(!0),
                            "float": e.css("float")
                        },
                        s = t("<div></div>").addClass("ui-effects-wrapper").css({
                            fontSize: "100%",
                            background: "transparent",
                            border: "none",
                            margin: 0,
                            padding: 0
                        }),
                        n = {
                            width: e.width(),
                            height: e.height()
                        },
                        o = document.activeElement;
                    try {
                        o.id
                    } catch (a) {
                        o = document.body
                    }
                    return e.wrap(s), (e[0] === o || t.contains(e[0], o)) && t(o).focus(), s = e.parent(), "static" === e.css("position") ? (s.css({
                        position: "relative"
                    }), e.css({
                        position: "relative"
                    })) : (t.extend(i, {
                        position: e.css("position"),
                        zIndex: e.css("z-index")
                    }), t.each(["top", "left", "bottom", "right"], function(t, s) {
                        i[s] = e.css(s), isNaN(parseInt(i[s], 10)) && (i[s] = "auto")
                    }), e.css({
                        position: "relative",
                        top: 0,
                        left: 0,
                        right: "auto",
                        bottom: "auto"
                    })), e.css(n), s.css(i).show()
                },
                removeWrapper: function(e) {
                    var i = document.activeElement;
                    return e.parent().is(".ui-effects-wrapper") && (e.parent().replaceWith(e), (e[0] === i || t.contains(e[0], i)) && t(i).focus()), e
                },
                setTransition: function(e, i, s, n) {
                    return n = n || {}, t.each(i, function(t, i) {
                        var o = e.cssUnit(i);
                        o[0] > 0 && (n[i] = o[0] * s + o[1])
                    }), n
                }
            }), t.fn.extend({
                effect: function() {
                    function i(e) {
                        function i() {
                            t.isFunction(o) && o.call(n[0]), t.isFunction(e) && e()
                        }
                        var n = t(this),
                            o = s.complete,
                            r = s.mode;
                        (n.is(":hidden") ? "hide" === r : "show" === r) ? (n[r](), i()) : a.call(n[0], s, i)
                    }
                    var s = e.apply(this, arguments),
                        n = s.mode,
                        o = s.queue,
                        a = t.effects.effect[s.effect];
                    return t.fx.off || !a ? n ? this[n](s.duration, s.complete) : this.each(function() {
                        s.complete && s.complete.call(this)
                    }) : o === !1 ? this.each(i) : this.queue(o || "fx", i)
                },
                show: function(t) {
                    return function(s) {
                        if (i(s)) return t.apply(this, arguments);
                        var n = e.apply(this, arguments);
                        return n.mode = "show", this.effect.call(this, n)
                    }
                }(t.fn.show),
                hide: function(t) {
                    return function(s) {
                        if (i(s)) return t.apply(this, arguments);
                        var n = e.apply(this, arguments);
                        return n.mode = "hide", this.effect.call(this, n)
                    }
                }(t.fn.hide),
                toggle: function(t) {
                    return function(s) {
                        if (i(s) || "boolean" == typeof s) return t.apply(this, arguments);
                        var n = e.apply(this, arguments);
                        return n.mode = "toggle", this.effect.call(this, n)
                    }
                }(t.fn.toggle),
                cssUnit: function(e) {
                    var i = this.css(e),
                        s = [];
                    return t.each(["em", "px", "%", "pt"], function(t, e) {
                        i.indexOf(e) > 0 && (s = [parseFloat(i), e])
                    }), s
                }
            })
        }(),
        function() {
            var e = {};
            t.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function(t, i) {
                e[i] = function(e) {
                    return Math.pow(e, t + 2)
                }
            }), t.extend(e, {
                Sine: function(t) {
                    return 1 - Math.cos(t * Math.PI / 2)
                },
                Circ: function(t) {
                    return 1 - Math.sqrt(1 - t * t)
                },
                Elastic: function(t) {
                    return 0 === t || 1 === t ? t : -Math.pow(2, 8 * (t - 1)) * Math.sin((80 * (t - 1) - 7.5) * Math.PI / 15)
                },
                Back: function(t) {
                    return t * t * (3 * t - 2)
                },
                Bounce: function(t) {
                    for (var e, i = 4; t < ((e = Math.pow(2, --i)) - 1) / 11;);
                    return 1 / Math.pow(4, 3 - i) - 7.5625 * Math.pow((3 * e - 2) / 22 - t, 2)
                }
            }), t.each(e, function(e, i) {
                t.easing["easeIn" + e] = i, t.easing["easeOut" + e] = function(t) {
                    return 1 - i(1 - t)
                }, t.easing["easeInOut" + e] = function(t) {
                    return .5 > t ? i(2 * t) / 2 : 1 - i(-2 * t + 2) / 2
                }
            })
        }();
    t.effects, t.effects.effect.blind = function(e, i) {
        var s, n, o, a = t(this),
            r = /up|down|vertical/,
            h = /up|left|vertical|horizontal/,
            l = ["position", "top", "bottom", "left", "right", "height", "width"],
            c = t.effects.setMode(a, e.mode || "hide"),
            u = e.direction || "up",
            d = r.test(u),
            p = d ? "height" : "width",
            f = d ? "top" : "left",
            m = h.test(u),
            g = {},
            v = "show" === c;
        a.parent().is(".ui-effects-wrapper") ? t.effects.save(a.parent(), l) : t.effects.save(a, l), a.show(), s = t.effects.createWrapper(a).css({
            overflow: "hidden"
        }), n = s[p](), o = parseFloat(s.css(f)) || 0, g[p] = v ? n : 0, m || (a.css(d ? "bottom" : "right", 0).css(d ? "top" : "left", "auto").css({
            position: "absolute"
        }), g[f] = v ? o : n + o), v && (s.css(p, 0), m || s.css(f, o + n)), s.animate(g, {
            duration: e.duration,
            easing: e.easing,
            queue: !1,
            complete: function() {
                "hide" === c && a.hide(), t.effects.restore(a, l), t.effects.removeWrapper(a), i()
            }
        })
    }, t.effects.effect.bounce = function(e, i) {
        var s, n, o, a = t(this),
            r = ["position", "top", "bottom", "left", "right", "height", "width"],
            h = t.effects.setMode(a, e.mode || "effect"),
            l = "hide" === h,
            c = "show" === h,
            u = e.direction || "up",
            d = e.distance,
            p = e.times || 5,
            f = 2 * p + (c || l ? 1 : 0),
            m = e.duration / f,
            g = e.easing,
            v = "up" === u || "down" === u ? "top" : "left",
            _ = "up" === u || "left" === u,
            b = a.queue(),
            y = b.length;
        for ((c || l) && r.push("opacity"), t.effects.save(a, r), a.show(), t.effects.createWrapper(a), d || (d = a["top" === v ? "outerHeight" : "outerWidth"]() / 3), c && (o = {
                opacity: 1
            }, o[v] = 0, a.css("opacity", 0).css(v, _ ? 2 * -d : 2 * d).animate(o, m, g)), l && (d /= Math.pow(2, p - 1)), o = {}, o[v] = 0, s = 0; p > s; s++) n = {}, n[v] = (_ ? "-=" : "+=") + d, a.animate(n, m, g).animate(o, m, g), d = l ? 2 * d : d / 2;
        l && (n = {
            opacity: 0
        }, n[v] = (_ ? "-=" : "+=") + d, a.animate(n, m, g)), a.queue(function() {
            l && a.hide(), t.effects.restore(a, r), t.effects.removeWrapper(a), i()
        }), y > 1 && b.splice.apply(b, [1, 0].concat(b.splice(y, f + 1))), a.dequeue()
    }, t.effects.effect.clip = function(e, i) {
        var s, n, o, a = t(this),
            r = ["position", "top", "bottom", "left", "right", "height", "width"],
            h = t.effects.setMode(a, e.mode || "hide"),
            l = "show" === h,
            c = e.direction || "vertical",
            u = "vertical" === c,
            d = u ? "height" : "width",
            p = u ? "top" : "left",
            f = {};
        t.effects.save(a, r), a.show(), s = t.effects.createWrapper(a).css({
            overflow: "hidden"
        }), n = "IMG" === a[0].tagName ? s : a, o = n[d](), l && (n.css(d, 0), n.css(p, o / 2)), f[d] = l ? o : 0, f[p] = l ? 0 : o / 2, n.animate(f, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: function() {
                l || a.hide(), t.effects.restore(a, r), t.effects.removeWrapper(a), i()
            }
        })
    }, t.effects.effect.drop = function(e, i) {
        var s, n = t(this),
            o = ["position", "top", "bottom", "left", "right", "opacity", "height", "width"],
            a = t.effects.setMode(n, e.mode || "hide"),
            r = "show" === a,
            h = e.direction || "left",
            l = "up" === h || "down" === h ? "top" : "left",
            c = "up" === h || "left" === h ? "pos" : "neg",
            u = {
                opacity: r ? 1 : 0
            };
        t.effects.save(n, o), n.show(), t.effects.createWrapper(n), s = e.distance || n["top" === l ? "outerHeight" : "outerWidth"](!0) / 2, r && n.css("opacity", 0).css(l, "pos" === c ? -s : s), u[l] = (r ? "pos" === c ? "+=" : "-=" : "pos" === c ? "-=" : "+=") + s, n.animate(u, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: function() {
                "hide" === a && n.hide(), t.effects.restore(n, o), t.effects.removeWrapper(n), i()
            }
        })
    }, t.effects.effect.explode = function(e, i) {
        function s() {
            b.push(this), b.length === u * d && n()
        }

        function n() {
            p.css({
                visibility: "visible"
            }), t(b).remove(), m || p.hide(), i()
        }
        var o, a, r, h, l, c, u = e.pieces ? Math.round(Math.sqrt(e.pieces)) : 3,
            d = u,
            p = t(this),
            f = t.effects.setMode(p, e.mode || "hide"),
            m = "show" === f,
            g = p.show().css("visibility", "hidden").offset(),
            v = Math.ceil(p.outerWidth() / d),
            _ = Math.ceil(p.outerHeight() / u),
            b = [];
        for (o = 0; u > o; o++)
            for (h = g.top + o * _, c = o - (u - 1) / 2, a = 0; d > a; a++) r = g.left + a * v, l = a - (d - 1) / 2, p.clone().appendTo("body").wrap("<div></div>").css({
                position: "absolute",
                visibility: "visible",
                left: -a * v,
                top: -o * _
            }).parent().addClass("ui-effects-explode").css({
                position: "absolute",
                overflow: "hidden",
                width: v,
                height: _,
                left: r + (m ? l * v : 0),
                top: h + (m ? c * _ : 0),
                opacity: m ? 0 : 1
            }).animate({
                left: r + (m ? 0 : l * v),
                top: h + (m ? 0 : c * _),
                opacity: m ? 1 : 0
            }, e.duration || 500, e.easing, s)
    }, t.effects.effect.fade = function(e, i) {
        var s = t(this),
            n = t.effects.setMode(s, e.mode || "toggle");
        s.animate({
            opacity: n
        }, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: i
        })
    }, t.effects.effect.fold = function(e, i) {
        var s, n, o = t(this),
            a = ["position", "top", "bottom", "left", "right", "height", "width"],
            r = t.effects.setMode(o, e.mode || "hide"),
            h = "show" === r,
            l = "hide" === r,
            c = e.size || 15,
            u = /([0-9]+)%/.exec(c),
            d = !!e.horizFirst,
            p = h !== d,
            f = p ? ["width", "height"] : ["height", "width"],
            m = e.duration / 2,
            g = {},
            v = {};
        t.effects.save(o, a), o.show(), s = t.effects.createWrapper(o).css({
            overflow: "hidden"
        }), n = p ? [s.width(), s.height()] : [s.height(), s.width()], u && (c = parseInt(u[1], 10) / 100 * n[l ? 0 : 1]), h && s.css(d ? {
            height: 0,
            width: c
        } : {
            height: c,
            width: 0
        }), g[f[0]] = h ? n[0] : c, v[f[1]] = h ? n[1] : 0, s.animate(g, m, e.easing).animate(v, m, e.easing, function() {
            l && o.hide(), t.effects.restore(o, a), t.effects.removeWrapper(o), i()
        })
    }, t.effects.effect.highlight = function(e, i) {
        var s = t(this),
            n = ["backgroundImage", "backgroundColor", "opacity"],
            o = t.effects.setMode(s, e.mode || "show"),
            a = {
                backgroundColor: s.css("backgroundColor")
            };
        "hide" === o && (a.opacity = 0), t.effects.save(s, n), s.show().css({
            backgroundImage: "none",
            backgroundColor: e.color || "#ffff99"
        }).animate(a, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: function() {
                "hide" === o && s.hide(), t.effects.restore(s, n), i()
            }
        })
    }, t.effects.effect.size = function(e, i) {
        var s, n, o, a = t(this),
            r = ["position", "top", "bottom", "left", "right", "width", "height", "overflow", "opacity"],
            h = ["position", "top", "bottom", "left", "right", "overflow", "opacity"],
            l = ["width", "height", "overflow"],
            c = ["fontSize"],
            u = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
            d = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
            p = t.effects.setMode(a, e.mode || "effect"),
            f = e.restore || "effect" !== p,
            m = e.scale || "both",
            g = e.origin || ["middle", "center"],
            v = a.css("position"),
            _ = f ? r : h,
            b = {
                height: 0,
                width: 0,
                outerHeight: 0,
                outerWidth: 0
            };
        "show" === p && a.show(), s = {
            height: a.height(),
            width: a.width(),
            outerHeight: a.outerHeight(),
            outerWidth: a.outerWidth()
        }, "toggle" === e.mode && "show" === p ? (a.from = e.to || b, a.to = e.from || s) : (a.from = e.from || ("show" === p ? b : s), a.to = e.to || ("hide" === p ? b : s)), o = {
            from: {
                y: a.from.height / s.height,
                x: a.from.width / s.width
            },
            to: {
                y: a.to.height / s.height,
                x: a.to.width / s.width
            }
        }, ("box" === m || "both" === m) && (o.from.y !== o.to.y && (_ = _.concat(u), a.from = t.effects.setTransition(a, u, o.from.y, a.from), a.to = t.effects.setTransition(a, u, o.to.y, a.to)), o.from.x !== o.to.x && (_ = _.concat(d), a.from = t.effects.setTransition(a, d, o.from.x, a.from), a.to = t.effects.setTransition(a, d, o.to.x, a.to))), ("content" === m || "both" === m) && o.from.y !== o.to.y && (_ = _.concat(c).concat(l), a.from = t.effects.setTransition(a, c, o.from.y, a.from), a.to = t.effects.setTransition(a, c, o.to.y, a.to)), t.effects.save(a, _), a.show(), t.effects.createWrapper(a), a.css("overflow", "hidden").css(a.from), g && (n = t.effects.getBaseline(g, s), a.from.top = (s.outerHeight - a.outerHeight()) * n.y, a.from.left = (s.outerWidth - a.outerWidth()) * n.x, a.to.top = (s.outerHeight - a.to.outerHeight) * n.y, a.to.left = (s.outerWidth - a.to.outerWidth) * n.x), a.css(a.from), ("content" === m || "both" === m) && (u = u.concat(["marginTop", "marginBottom"]).concat(c), d = d.concat(["marginLeft", "marginRight"]), l = r.concat(u).concat(d), a.find("*[width]").each(function() {
            var i = t(this),
                s = {
                    height: i.height(),
                    width: i.width(),
                    outerHeight: i.outerHeight(),
                    outerWidth: i.outerWidth()
                };
            f && t.effects.save(i, l), i.from = {
                height: s.height * o.from.y,
                width: s.width * o.from.x,
                outerHeight: s.outerHeight * o.from.y,
                outerWidth: s.outerWidth * o.from.x
            }, i.to = {
                height: s.height * o.to.y,
                width: s.width * o.to.x,
                outerHeight: s.height * o.to.y,
                outerWidth: s.width * o.to.x
            }, o.from.y !== o.to.y && (i.from = t.effects.setTransition(i, u, o.from.y, i.from), i.to = t.effects.setTransition(i, u, o.to.y, i.to)), o.from.x !== o.to.x && (i.from = t.effects.setTransition(i, d, o.from.x, i.from), i.to = t.effects.setTransition(i, d, o.to.x, i.to)), i.css(i.from), i.animate(i.to, e.duration, e.easing, function() {
                f && t.effects.restore(i, l)
            })
        })), a.animate(a.to, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: function() {
                0 === a.to.opacity && a.css("opacity", a.from.opacity), "hide" === p && a.hide(), t.effects.restore(a, _), f || ("static" === v ? a.css({
                    position: "relative",
                    top: a.to.top,
                    left: a.to.left
                }) : t.each(["top", "left"], function(t, e) {
                    a.css(e, function(e, i) {
                        var s = parseInt(i, 10),
                            n = t ? a.to.left : a.to.top;
                        return "auto" === i ? n + "px" : s + n + "px"
                    })
                })), t.effects.removeWrapper(a), i()
            }
        })
    }, t.effects.effect.scale = function(e, i) {
        var s = t(this),
            n = t.extend(!0, {}, e),
            o = t.effects.setMode(s, e.mode || "effect"),
            a = parseInt(e.percent, 10) || (0 === parseInt(e.percent, 10) ? 0 : "hide" === o ? 0 : 100),
            r = e.direction || "both",
            h = e.origin,
            l = {
                height: s.height(),
                width: s.width(),
                outerHeight: s.outerHeight(),
                outerWidth: s.outerWidth()
            },
            c = {
                y: "horizontal" !== r ? a / 100 : 1,
                x: "vertical" !== r ? a / 100 : 1
            };
        n.effect = "size", n.queue = !1, n.complete = i, "effect" !== o && (n.origin = h || ["middle", "center"], n.restore = !0), n.from = e.from || ("show" === o ? {
            height: 0,
            width: 0,
            outerHeight: 0,
            outerWidth: 0
        } : l), n.to = {
            height: l.height * c.y,
            width: l.width * c.x,
            outerHeight: l.outerHeight * c.y,
            outerWidth: l.outerWidth * c.x
        }, n.fade && ("show" === o && (n.from.opacity = 0, n.to.opacity = 1), "hide" === o && (n.from.opacity = 1, n.to.opacity = 0)), s.effect(n)
    }, t.effects.effect.puff = function(e, i) {
        var s = t(this),
            n = t.effects.setMode(s, e.mode || "hide"),
            o = "hide" === n,
            a = parseInt(e.percent, 10) || 150,
            r = a / 100,
            h = {
                height: s.height(),
                width: s.width(),
                outerHeight: s.outerHeight(),
                outerWidth: s.outerWidth()
            };
        t.extend(e, {
            effect: "scale",
            queue: !1,
            fade: !0,
            mode: n,
            complete: i,
            percent: o ? a : 100,
            from: o ? h : {
                height: h.height * r,
                width: h.width * r,
                outerHeight: h.outerHeight * r,
                outerWidth: h.outerWidth * r
            }
        }), s.effect(e)
    }, t.effects.effect.pulsate = function(e, i) {
        var s, n = t(this),
            o = t.effects.setMode(n, e.mode || "show"),
            a = "show" === o,
            r = "hide" === o,
            h = a || "hide" === o,
            l = 2 * (e.times || 5) + (h ? 1 : 0),
            c = e.duration / l,
            u = 0,
            d = n.queue(),
            p = d.length;
        for ((a || !n.is(":visible")) && (n.css("opacity", 0).show(), u = 1), s = 1; l > s; s++) n.animate({
            opacity: u
        }, c, e.easing), u = 1 - u;
        n.animate({
            opacity: u
        }, c, e.easing), n.queue(function() {
            r && n.hide(), i()
        }), p > 1 && d.splice.apply(d, [1, 0].concat(d.splice(p, l + 1))), n.dequeue()
    }, t.effects.effect.shake = function(e, i) {
        var s, n = t(this),
            o = ["position", "top", "bottom", "left", "right", "height", "width"],
            a = t.effects.setMode(n, e.mode || "effect"),
            r = e.direction || "left",
            h = e.distance || 20,
            l = e.times || 3,
            c = 2 * l + 1,
            u = Math.round(e.duration / c),
            d = "up" === r || "down" === r ? "top" : "left",
            p = "up" === r || "left" === r,
            f = {},
            m = {},
            g = {},
            v = n.queue(),
            _ = v.length;
        for (t.effects.save(n, o), n.show(), t.effects.createWrapper(n), f[d] = (p ? "-=" : "+=") + h, m[d] = (p ? "+=" : "-=") + 2 * h, g[d] = (p ? "-=" : "+=") + 2 * h, n.animate(f, u, e.easing), s = 1; l > s; s++) n.animate(m, u, e.easing).animate(g, u, e.easing);
        n.animate(m, u, e.easing).animate(f, u / 2, e.easing).queue(function() {
            "hide" === a && n.hide(), t.effects.restore(n, o), t.effects.removeWrapper(n), i()
        }), _ > 1 && v.splice.apply(v, [1, 0].concat(v.splice(_, c + 1))), n.dequeue()
    }, t.effects.effect.slide = function(e, i) {
        var s, n = t(this),
            o = ["position", "top", "bottom", "left", "right", "width", "height"],
            a = t.effects.setMode(n, e.mode || "show"),
            r = "show" === a,
            h = e.direction || "left",
            l = "up" === h || "down" === h ? "top" : "left",
            c = "up" === h || "left" === h,
            u = {};
        t.effects.save(n, o), n.show(), s = e.distance || n["top" === l ? "outerHeight" : "outerWidth"](!0), t.effects.createWrapper(n).css({
            overflow: "hidden"
        }), r && n.css(l, c ? isNaN(s) ? "-" + s : -s : s), u[l] = (r ? c ? "+=" : "-=" : c ? "-=" : "+=") + s, n.animate(u, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: function() {
                "hide" === a && n.hide(), t.effects.restore(n, o), t.effects.removeWrapper(n), i()
            }
        })
    }, t.effects.effect.transfer = function(e, i) {
        var s = t(this),
            n = t(e.to),
            o = "fixed" === n.css("position"),
            a = t("body"),
            r = o ? a.scrollTop() : 0,
            h = o ? a.scrollLeft() : 0,
            l = n.offset(),
            c = {
                top: l.top - r,
                left: l.left - h,
                height: n.innerHeight(),
                width: n.innerWidth()
            },
            u = s.offset(),
            d = t("<div class='ui-effects-transfer'></div>").appendTo(document.body).addClass(e.className).css({
                top: u.top - r,
                left: u.left - h,
                height: s.innerHeight(),
                width: s.innerWidth(),
                position: o ? "fixed" : "absolute"
            }).animate(c, e.duration, e.easing, function() {
                d.remove(), i()
            })
    }, t.widget("ui.progressbar", {
        version: "1.11.0",
        options: {
            max: 100,
            value: 0,
            change: null,
            complete: null
        },
        min: 0,
        _create: function() {
            this.oldValue = this.options.value = this._constrainedValue(), this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({
                role: "progressbar",
                "aria-valuemin": this.min
            }), this.valueDiv = t("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element), this._refreshValue()
        },
        _destroy: function() {
            this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.valueDiv.remove()
        },
        value: function(t) {
            return void 0 === t ? this.options.value : (this.options.value = this._constrainedValue(t), void this._refreshValue())
        },
        _constrainedValue: function(t) {
            return void 0 === t && (t = this.options.value), this.indeterminate = t === !1, "number" != typeof t && (t = 0), this.indeterminate ? !1 : Math.min(this.options.max, Math.max(this.min, t))
        },
        _setOptions: function(t) {
            var e = t.value;
            delete t.value, this._super(t), this.options.value = this._constrainedValue(e), this._refreshValue()
        },
        _setOption: function(t, e) {
            "max" === t && (e = Math.max(this.min, e)), "disabled" === t && this.element.toggleClass("ui-state-disabled", !!e).attr("aria-disabled", e), this._super(t, e)
        },
        _percentage: function() {
            return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min)
        },
        _refreshValue: function() {
            var e = this.options.value,
                i = this._percentage();
            this.valueDiv.toggle(this.indeterminate || e > this.min).toggleClass("ui-corner-right", e === this.options.max).width(i.toFixed(0) + "%"), this.element.toggleClass("ui-progressbar-indeterminate", this.indeterminate), this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv || (this.overlayDiv = t("<div class='ui-progressbar-overlay'></div>").appendTo(this.valueDiv))) : (this.element.attr({
                "aria-valuemax": this.options.max,
                "aria-valuenow": e
            }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)), this.oldValue !== e && (this.oldValue = e, this._trigger("change")), e === this.options.max && this._trigger("complete")
        }
    }), t.widget("ui.selectable", t.ui.mouse, {
        version: "1.11.0",
        options: {
            appendTo: "body",
            autoRefresh: !0,
            distance: 0,
            filter: "*",
            tolerance: "touch",
            selected: null,
            selecting: null,
            start: null,
            stop: null,
            unselected: null,
            unselecting: null
        },
        _create: function() {
            var e, i = this;
            this.element.addClass("ui-selectable"), this.dragged = !1, this.refresh = function() {
                e = t(i.options.filter, i.element[0]), e.addClass("ui-selectee"), e.each(function() {
                    var e = t(this),
                        i = e.offset();
                    t.data(this, "selectable-item", {
                        element: this,
                        $element: e,
                        left: i.left,
                        top: i.top,
                        right: i.left + e.outerWidth(),
                        bottom: i.top + e.outerHeight(),
                        startselected: !1,
                        selected: e.hasClass("ui-selected"),
                        selecting: e.hasClass("ui-selecting"),
                        unselecting: e.hasClass("ui-unselecting")
                    })
                })
            }, this.refresh(), this.selectees = e.addClass("ui-selectee"), this._mouseInit(), this.helper = t("<div class='ui-selectable-helper'></div>")
        },
        _destroy: function() {
            this.selectees.removeClass("ui-selectee").removeData("selectable-item"), this.element.removeClass("ui-selectable ui-selectable-disabled"), this._mouseDestroy()
        },
        _mouseStart: function(e) {
            var i = this,
                s = this.options;
            this.opos = [e.pageX, e.pageY], this.options.disabled || (this.selectees = t(s.filter, this.element[0]), this._trigger("start", e), t(s.appendTo).append(this.helper), this.helper.css({
                left: e.pageX,
                top: e.pageY,
                width: 0,
                height: 0
            }), s.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function() {
                var s = t.data(this, "selectable-item");
                s.startselected = !0, e.metaKey || e.ctrlKey || (s.$element.removeClass("ui-selected"), s.selected = !1, s.$element.addClass("ui-unselecting"), s.unselecting = !0, i._trigger("unselecting", e, {
                    unselecting: s.element
                }))
            }), t(e.target).parents().addBack().each(function() {
                var s, n = t.data(this, "selectable-item");
                return n ? (s = !e.metaKey && !e.ctrlKey || !n.$element.hasClass("ui-selected"), n.$element.removeClass(s ? "ui-unselecting" : "ui-selected").addClass(s ? "ui-selecting" : "ui-unselecting"), n.unselecting = !s, n.selecting = s, n.selected = s, s ? i._trigger("selecting", e, {
                    selecting: n.element
                }) : i._trigger("unselecting", e, {
                    unselecting: n.element
                }), !1) : void 0
            }))
        },
        _mouseDrag: function(e) {
            if (this.dragged = !0, !this.options.disabled) {
                var i, s = this,
                    n = this.options,
                    o = this.opos[0],
                    a = this.opos[1],
                    r = e.pageX,
                    h = e.pageY;
                return o > r && (i = r, r = o, o = i), a > h && (i = h, h = a, a = i), this.helper.css({
                    left: o,
                    top: a,
                    width: r - o,
                    height: h - a
                }), this.selectees.each(function() {
                    var i = t.data(this, "selectable-item"),
                        l = !1;
                    i && i.element !== s.element[0] && ("touch" === n.tolerance ? l = !(i.left > r || i.right < o || i.top > h || i.bottom < a) : "fit" === n.tolerance && (l = i.left > o && i.right < r && i.top > a && i.bottom < h), l ? (i.selected && (i.$element.removeClass("ui-selected"), i.selected = !1), i.unselecting && (i.$element.removeClass("ui-unselecting"), i.unselecting = !1), i.selecting || (i.$element.addClass("ui-selecting"), i.selecting = !0, s._trigger("selecting", e, {
                        selecting: i.element
                    }))) : (i.selecting && ((e.metaKey || e.ctrlKey) && i.startselected ? (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.$element.addClass("ui-selected"), i.selected = !0) : (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.startselected && (i.$element.addClass("ui-unselecting"), i.unselecting = !0), s._trigger("unselecting", e, {
                        unselecting: i.element
                    }))), i.selected && (e.metaKey || e.ctrlKey || i.startselected || (i.$element.removeClass("ui-selected"), i.selected = !1, i.$element.addClass("ui-unselecting"), i.unselecting = !0, s._trigger("unselecting", e, {
                        unselecting: i.element
                    })))))
                }), !1
            }
        },
        _mouseStop: function(e) {
            var i = this;
            return this.dragged = !1, t(".ui-unselecting", this.element[0]).each(function() {
                var s = t.data(this, "selectable-item");
                s.$element.removeClass("ui-unselecting"), s.unselecting = !1, s.startselected = !1, i._trigger("unselected", e, {
                    unselected: s.element
                })
            }), t(".ui-selecting", this.element[0]).each(function() {
                var s = t.data(this, "selectable-item");
                s.$element.removeClass("ui-selecting").addClass("ui-selected"), s.selecting = !1, s.selected = !0, s.startselected = !0, i._trigger("selected", e, {
                    selected: s.element
                })
            }), this._trigger("stop", e), this.helper.remove(), !1
        }
    }), t.widget("ui.selectmenu", {
        version: "1.11.0",
        defaultElement: "<select>",
        options: {
            appendTo: null,
            disabled: null,
            icons: {
                button: "ui-icon-triangle-1-s"
            },
            position: {
                my: "left top",
                at: "left bottom",
                collision: "none"
            },
            width: null,
            change: null,
            close: null,
            focus: null,
            open: null,
            select: null
        },
        _create: function() {
            var t = this.element.uniqueId().attr("id");
            this.ids = {
                element: t,
                button: t + "-button",
                menu: t + "-menu"
            }, this._drawButton(), this._drawMenu(), this.options.disabled && this.disable()
        },
        _drawButton: function() {
            var e = this,
                i = this.element.attr("tabindex");
            this.label = t("label[for='" + this.ids.element + "']").attr("for", this.ids.button), this._on(this.label, {
                click: function(t) {
                    this.button.focus(), t.preventDefault()
                }
            }), this.element.hide(), this.button = t("<span>", {
                "class": "ui-selectmenu-button ui-widget ui-state-default ui-corner-all",
                tabindex: i || this.options.disabled ? -1 : 0,
                id: this.ids.button,
                role: "combobox",
                "aria-expanded": "false",
                "aria-autocomplete": "list",
                "aria-owns": this.ids.menu,
                "aria-haspopup": "true"
            }).insertAfter(this.element), t("<span>", {
                "class": "ui-icon " + this.options.icons.button
            }).prependTo(this.button), this.buttonText = t("<span>", {
                "class": "ui-selectmenu-text"
            }).appendTo(this.button), this._setText(this.buttonText, this.element.find("option:selected").text()), this._setOption("width", this.options.width), this._on(this.button, this._buttonEvents), this.button.one("focusin", function() {
                e.menuItems || e._refreshMenu()
            }), this._hoverable(this.button), this._focusable(this.button)
        },
        _drawMenu: function() {
            var e = this;
            this.menu = t("<ul>", {
                "aria-hidden": "true",
                "aria-labelledby": this.ids.button,
                id: this.ids.menu
            }), this.menuWrap = t("<div>", {
                "class": "ui-selectmenu-menu ui-front"
            }).append(this.menu).appendTo(this._appendTo()), this.menuInstance = this.menu.menu({
                role: "listbox",
                select: function(t, i) {
                    t.preventDefault(), e._select(i.item.data("ui-selectmenu-item"), t)
                },
                focus: function(t, i) {
                    var s = i.item.data("ui-selectmenu-item");
                    null != e.focusIndex && s.index !== e.focusIndex && (e._trigger("focus", t, {
                        item: s
                    }), e.isOpen || e._select(s, t)), e.focusIndex = s.index, e.button.attr("aria-activedescendant", e.menuItems.eq(s.index).attr("id"))
                }
            }).menu("instance"), this.menu.addClass("ui-corner-bottom").removeClass("ui-corner-all"), this.menuInstance._off(this.menu, "mouseleave"), this.menuInstance._closeOnDocumentClick = function() {
                return !1
            }, this.menuInstance._isDivider = function() {
                return !1
            }
        },
        refresh: function() {
            this._refreshMenu(), this._setText(this.buttonText, this._getSelectedItem().text()), this._setOption("width", this.options.width)
        },
        _refreshMenu: function() {
            this.menu.empty();
            var t, e = this.element.find("option");
            e.length && (this._parseOptions(e), this._renderMenu(this.menu, this.items), this.menuInstance.refresh(), this.menuItems = this.menu.find("li").not(".ui-selectmenu-optgroup"), t = this._getSelectedItem(), this.menuInstance.focus(null, t), this._setAria(t.data("ui-selectmenu-item")), this._setOption("disabled", this.element.prop("disabled")))
        },
        open: function(t) {
            this.options.disabled || (this.menuItems ? (this.menu.find(".ui-state-focus").removeClass("ui-state-focus"), this.menuInstance.focus(null, this._getSelectedItem())) : this._refreshMenu(), this.isOpen = !0, this._toggleAttr(), this._resizeMenu(), this._position(), this._on(this.document, this._documentClick), this._trigger("open", t))
        },
        _position: function() {
            this.menuWrap.position(t.extend({ of: this.button
            }, this.options.position))
        },
        close: function(t) {
            this.isOpen && (this.isOpen = !1, this._toggleAttr(), this._off(this.document), this._trigger("close", t))
        },
        widget: function() {
            return this.button
        },
        menuWidget: function() {
            return this.menu
        },
        _renderMenu: function(e, i) {
            var s = this,
                n = "";
            t.each(i, function(i, o) {
                o.optgroup !== n && (t("<li>", {
                    "class": "ui-selectmenu-optgroup ui-menu-divider" + (o.element.parent("optgroup").prop("disabled") ? " ui-state-disabled" : ""),
                    text: o.optgroup
                }).appendTo(e), n = o.optgroup), s._renderItemData(e, o)
            })
        },
        _renderItemData: function(t, e) {
            return this._renderItem(t, e).data("ui-selectmenu-item", e)
        },
        _renderItem: function(e, i) {
            var s = t("<li>");
            return i.disabled && s.addClass("ui-state-disabled"), this._setText(s, i.label), s.appendTo(e)
        },
        _setText: function(t, e) {
            e ? t.text(e) : t.html("&#160;")
        },
        _move: function(t, e) {
            var i, s, n = ".ui-menu-item";
            this.isOpen ? i = this.menuItems.eq(this.focusIndex) : (i = this.menuItems.eq(this.element[0].selectedIndex), n += ":not(.ui-state-disabled)"), s = "first" === t || "last" === t ? i["first" === t ? "prevAll" : "nextAll"](n).eq(-1) : i[t + "All"](n).eq(0), s.length && this.menuInstance.focus(e, s)
        },
        _getSelectedItem: function() {
            return this.menuItems.eq(this.element[0].selectedIndex)
        },
        _toggle: function(t) {
            this[this.isOpen ? "close" : "open"](t)
        },
        _documentClick: {
            mousedown: function(e) {
                this.isOpen && (t(e.target).closest(".ui-selectmenu-menu, #" + this.ids.button).length || this.close(e))
            }
        },
        _buttonEvents: {
            click: "_toggle",
            keydown: function(e) {
                var i = !0;
                switch (e.keyCode) {
                    case t.ui.keyCode.TAB:
                    case t.ui.keyCode.ESCAPE:
                        this.close(e), i = !1;
                        break;
                    case t.ui.keyCode.ENTER:
                        this.isOpen && this._selectFocusedItem(e);
                        break;
                    case t.ui.keyCode.UP:
                        e.altKey ? this._toggle(e) : this._move("prev", e);
                        break;
                    case t.ui.keyCode.DOWN:
                        e.altKey ? this._toggle(e) : this._move("next", e);
                        break;
                    case t.ui.keyCode.SPACE:
                        this.isOpen ? this._selectFocusedItem(e) : this._toggle(e);
                        break;
                    case t.ui.keyCode.LEFT:
                        this._move("prev", e);
                        break;
                    case t.ui.keyCode.RIGHT:
                        this._move("next", e);
                        break;
                    case t.ui.keyCode.HOME:
                    case t.ui.keyCode.PAGE_UP:
                        this._move("first", e);
                        break;
                    case t.ui.keyCode.END:
                    case t.ui.keyCode.PAGE_DOWN:
                        this._move("last", e);
                        break;
                    default:
                        this.menu.trigger(e), i = !1
                }
                i && e.preventDefault()
            }
        },
        _selectFocusedItem: function(t) {
            var e = this.menuItems.eq(this.focusIndex);
            e.hasClass("ui-state-disabled") || this._select(e.data("ui-selectmenu-item"), t)
        },
        _select: function(t, e) {
            var i = this.element[0].selectedIndex;
            this.element[0].selectedIndex = t.index, this._setText(this.buttonText, t.label), this._setAria(t), this._trigger("select", e, {
                item: t
            }), t.index !== i && this._trigger("change", e, {
                item: t
            }), this.close(e)
        },
        _setAria: function(t) {
            var e = this.menuItems.eq(t.index).attr("id");
            this.button.attr({
                "aria-labelledby": e,
                "aria-activedescendant": e
            }), this.menu.attr("aria-activedescendant", e)
        },
        _setOption: function(t, e) {
            "icons" === t && this.button.find("span.ui-icon").removeClass(this.options.icons.button).addClass(e.button), this._super(t, e), "appendTo" === t && this.menuWrap.appendTo(this._appendTo()), "disabled" === t && (this.menuInstance.option("disabled", e), this.button.toggleClass("ui-state-disabled", e).attr("aria-disabled", e), this.element.prop("disabled", e), e ? (this.button.attr("tabindex", -1), this.close()) : this.button.attr("tabindex", 0)), "width" === t && (e || (e = this.element.outerWidth()), this.button.outerWidth(e))
        },
        _appendTo: function() {
            var e = this.options.appendTo;
            return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e && e[0] || (e = this.element.closest(".ui-front")), e.length || (e = this.document[0].body), e
        },
        _toggleAttr: function() {
            this.button.toggleClass("ui-corner-top", this.isOpen).toggleClass("ui-corner-all", !this.isOpen).attr("aria-expanded", this.isOpen), this.menuWrap.toggleClass("ui-selectmenu-open", this.isOpen), this.menu.attr("aria-hidden", !this.isOpen)
        },
        _resizeMenu: function() {
            this.menu.outerWidth(Math.max(this.button.outerWidth(), this.menu.width("").outerWidth() + 1))
        },
        _getCreateOptions: function() {
            return {
                disabled: this.element.prop("disabled")
            }
        },
        _parseOptions: function(e) {
            var i = [];
            e.each(function(e, s) {
                var n = t(s),
                    o = n.parent("optgroup");
                i.push({
                    element: n,
                    index: e,
                    value: n.attr("value"),
                    label: n.text(),
                    optgroup: o.attr("label") || "",
                    disabled: o.prop("disabled") || n.prop("disabled")
                })
            }), this.items = i
        },
        _destroy: function() {
            this.menuWrap.remove(), this.button.remove(), this.element.show(), this.element.removeUniqueId(), this.label.attr("for", this.ids.element)
        }
    }), t.widget("ui.slider", t.ui.mouse, {
        version: "1.11.0",
        widgetEventPrefix: "slide",
        options: {
            animate: !1,
            distance: 0,
            max: 100,
            min: 0,
            orientation: "horizontal",
            range: !1,
            step: 1,
            value: 0,
            values: null,
            change: null,
            slide: null,
            start: null,
            stop: null
        },
        numPages: 5,
        _create: function() {
            this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all"), this._refresh(), this._setOption("disabled", this.options.disabled), this._animateOff = !1
        },
        _refresh: function() {
            this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue()
        },
        _createHandles: function() {
            var e, i, s = this.options,
                n = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                o = "<span class='ui-slider-handle ui-state-default ui-corner-all' tabindex='0'></span>",
                a = [];
            for (i = s.values && s.values.length || 1, n.length > i && (n.slice(i).remove(), n = n.slice(0, i)), e = n.length; i > e; e++) a.push(o);
            this.handles = n.add(t(a.join("")).appendTo(this.element)), this.handle = this.handles.eq(0), this.handles.each(function(e) {
                t(this).data("ui-slider-handle-index", e)
            })
        },
        _createRange: function() {
            var e = this.options,
                i = "";
            e.range ? (e.range === !0 && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [e.values[0], e.values[0]] : t.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
                left: "",
                bottom: ""
            }) : (this.range = t("<div></div>").appendTo(this.element), i = "ui-slider-range ui-widget-header ui-corner-all"), this.range.addClass(i + ("min" === e.range || "max" === e.range ? " ui-slider-range-" + e.range : ""))) : (this.range && this.range.remove(), this.range = null)
        },
        _setupEvents: function() {
            this._off(this.handles), this._on(this.handles, this._handleEvents), this._hoverable(this.handles), this._focusable(this.handles)
        },
        _destroy: function() {
            this.handles.remove(), this.range && this.range.remove(), this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"), this._mouseDestroy()
        },
        _mouseCapture: function(e) {
            var i, s, n, o, a, r, h, l, c = this,
                u = this.options;
            return u.disabled ? !1 : (this.elementSize = {
                width: this.element.outerWidth(),
                height: this.element.outerHeight()
            }, this.elementOffset = this.element.offset(), i = {
                x: e.pageX,
                y: e.pageY
            }, s = this._normValueFromMouse(i), n = this._valueMax() - this._valueMin() + 1, this.handles.each(function(e) {
                var i = Math.abs(s - c.values(e));
                (n > i || n === i && (e === c._lastChangedValue || c.values(e) === u.min)) && (n = i, o = t(this), a = e)
            }), r = this._start(e, a), r === !1 ? !1 : (this._mouseSliding = !0, this._handleIndex = a, o.addClass("ui-state-active").focus(), h = o.offset(), l = !t(e.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = l ? {
                left: 0,
                top: 0
            } : {
                left: e.pageX - h.left - o.width() / 2,
                top: e.pageY - h.top - o.height() / 2 - (parseInt(o.css("borderTopWidth"), 10) || 0) - (parseInt(o.css("borderBottomWidth"), 10) || 0) + (parseInt(o.css("marginTop"), 10) || 0)
            }, this.handles.hasClass("ui-state-hover") || this._slide(e, a, s), this._animateOff = !0, !0))
        },
        _mouseStart: function() {
            return !0
        },
        _mouseDrag: function(t) {
            var e = {
                    x: t.pageX,
                    y: t.pageY
                },
                i = this._normValueFromMouse(e);
            return this._slide(t, this._handleIndex, i), !1
        },
        _mouseStop: function(t) {
            return this.handles.removeClass("ui-state-active"), this._mouseSliding = !1, this._stop(t, this._handleIndex), this._change(t, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1, !1
        },
        _detectOrientation: function() {
            this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal"
        },
        _normValueFromMouse: function(t) {
            var e, i, s, n, o;
            return "horizontal" === this.orientation ? (e = this.elementSize.width, i = t.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (e = this.elementSize.height, i = t.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), s = i / e, s > 1 && (s = 1), 0 > s && (s = 0), "vertical" === this.orientation && (s = 1 - s), n = this._valueMax() - this._valueMin(), o = this._valueMin() + s * n, this._trimAlignValue(o)
        },
        _start: function(t, e) {
            var i = {
                handle: this.handles[e],
                value: this.value()
            };
            return this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._trigger("start", t, i)
        },
        _slide: function(t, e, i) {
            var s, n, o;
            this.options.values && this.options.values.length ? (s = this.values(e ? 0 : 1), 2 === this.options.values.length && this.options.range === !0 && (0 === e && i > s || 1 === e && s > i) && (i = s), i !== this.values(e) && (n = this.values(), n[e] = i, o = this._trigger("slide", t, {
                handle: this.handles[e],
                value: i,
                values: n
            }), s = this.values(e ? 0 : 1), o !== !1 && this.values(e, i))) : i !== this.value() && (o = this._trigger("slide", t, {
                handle: this.handles[e],
                value: i
            }), o !== !1 && this.value(i))
        },
        _stop: function(t, e) {
            var i = {
                handle: this.handles[e],
                value: this.value()
            };
            this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._trigger("stop", t, i)
        },
        _change: function(t, e) {
            if (!this._keySliding && !this._mouseSliding) {
                var i = {
                    handle: this.handles[e],
                    value: this.value()
                };
                this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._lastChangedValue = e, this._trigger("change", t, i)
            }
        },
        value: function(t) {
            return arguments.length ? (this.options.value = this._trimAlignValue(t), this._refreshValue(), void this._change(null, 0)) : this._value()
        },
        values: function(e, i) {
            var s, n, o;
            if (arguments.length > 1) return this.options.values[e] = this._trimAlignValue(i), this._refreshValue(), void this._change(null, e);
            if (!arguments.length) return this._values();
            if (!t.isArray(arguments[0])) return this.options.values && this.options.values.length ? this._values(e) : this.value();
            for (s = this.options.values, n = arguments[0], o = 0; o < s.length; o += 1) s[o] = this._trimAlignValue(n[o]), this._change(null, o);
            this._refreshValue()
        },
        _setOption: function(e, i) {
            var s, n = 0;
            switch ("range" === e && this.options.range === !0 && ("min" === i ? (this.options.value = this._values(0), this.options.values = null) : "max" === i && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), t.isArray(this.options.values) && (n = this.options.values.length), "disabled" === e && this.element.toggleClass("ui-state-disabled", !!i), this._super(e, i), e) {
                case "orientation":
                    this._detectOrientation(), this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation), this._refreshValue();
                    break;
                case "value":
                    this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
                    break;
                case "values":
                    for (this._animateOff = !0, this._refreshValue(), s = 0; n > s; s += 1) this._change(null, s);
                    this._animateOff = !1;
                    break;
                case "min":
                case "max":
                    this._animateOff = !0, this._refreshValue(), this._animateOff = !1;
                    break;
                case "range":
                    this._animateOff = !0, this._refresh(), this._animateOff = !1
            }
        },
        _value: function() {
            var t = this.options.value;
            return t = this._trimAlignValue(t)
        },
        _values: function(t) {
            var e, i, s;
            if (arguments.length) return e = this.options.values[t], e = this._trimAlignValue(e);
            if (this.options.values && this.options.values.length) {
                for (i = this.options.values.slice(), s = 0; s < i.length; s += 1) i[s] = this._trimAlignValue(i[s]);
                return i
            }
            return []
        },
        _trimAlignValue: function(t) {
            if (t <= this._valueMin()) return this._valueMin();
            if (t >= this._valueMax()) return this._valueMax();
            var e = this.options.step > 0 ? this.options.step : 1,
                i = (t - this._valueMin()) % e,
                s = t - i;
            return 2 * Math.abs(i) >= e && (s += i > 0 ? e : -e), parseFloat(s.toFixed(5))
        },
        _valueMin: function() {
            return this.options.min
        },
        _valueMax: function() {
            return this.options.max
        },
        _refreshValue: function() {
            var e, i, s, n, o, a = this.options.range,
                r = this.options,
                h = this,
                l = this._animateOff ? !1 : r.animate,
                c = {};
            this.options.values && this.options.values.length ? this.handles.each(function(s) {
                i = (h.values(s) - h._valueMin()) / (h._valueMax() - h._valueMin()) * 100, c["horizontal" === h.orientation ? "left" : "bottom"] = i + "%", t(this).stop(1, 1)[l ? "animate" : "css"](c, r.animate), h.options.range === !0 && ("horizontal" === h.orientation ? (0 === s && h.range.stop(1, 1)[l ? "animate" : "css"]({
                    left: i + "%"
                }, r.animate), 1 === s && h.range[l ? "animate" : "css"]({
                    width: i - e + "%"
                }, {
                    queue: !1,
                    duration: r.animate
                })) : (0 === s && h.range.stop(1, 1)[l ? "animate" : "css"]({
                    bottom: i + "%"
                }, r.animate), 1 === s && h.range[l ? "animate" : "css"]({
                    height: i - e + "%"
                }, {
                    queue: !1,
                    duration: r.animate
                }))), e = i
            }) : (s = this.value(), n = this._valueMin(), o = this._valueMax(), i = o !== n ? (s - n) / (o - n) * 100 : 0, c["horizontal" === this.orientation ? "left" : "bottom"] = i + "%", this.handle.stop(1, 1)[l ? "animate" : "css"](c, r.animate), "min" === a && "horizontal" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                width: i + "%"
            }, r.animate), "max" === a && "horizontal" === this.orientation && this.range[l ? "animate" : "css"]({
                width: 100 - i + "%"
            }, {
                queue: !1,
                duration: r.animate
            }), "min" === a && "vertical" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                height: i + "%"
            }, r.animate), "max" === a && "vertical" === this.orientation && this.range[l ? "animate" : "css"]({
                height: 100 - i + "%"
            }, {
                queue: !1,
                duration: r.animate
            }))
        },
        _handleEvents: {
            keydown: function(e) {
                var i, s, n, o, a = t(e.target).data("ui-slider-handle-index");
                switch (e.keyCode) {
                    case t.ui.keyCode.HOME:
                    case t.ui.keyCode.END:
                    case t.ui.keyCode.PAGE_UP:
                    case t.ui.keyCode.PAGE_DOWN:
                    case t.ui.keyCode.UP:
                    case t.ui.keyCode.RIGHT:
                    case t.ui.keyCode.DOWN:
                    case t.ui.keyCode.LEFT:
                        if (e.preventDefault(), !this._keySliding && (this._keySliding = !0, t(e.target).addClass("ui-state-active"), i = this._start(e, a), i === !1)) return
                }
                switch (o = this.options.step, s = n = this.options.values && this.options.values.length ? this.values(a) : this.value(), e.keyCode) {
                    case t.ui.keyCode.HOME:
                        n = this._valueMin();
                        break;
                    case t.ui.keyCode.END:
                        n = this._valueMax();
                        break;
                    case t.ui.keyCode.PAGE_UP:
                        n = this._trimAlignValue(s + (this._valueMax() - this._valueMin()) / this.numPages);
                        break;
                    case t.ui.keyCode.PAGE_DOWN:
                        n = this._trimAlignValue(s - (this._valueMax() - this._valueMin()) / this.numPages);
                        break;
                    case t.ui.keyCode.UP:
                    case t.ui.keyCode.RIGHT:
                        if (s === this._valueMax()) return;
                        n = this._trimAlignValue(s + o);
                        break;
                    case t.ui.keyCode.DOWN:
                    case t.ui.keyCode.LEFT:
                        if (s === this._valueMin()) return;
                        n = this._trimAlignValue(s - o)
                }
                this._slide(e, a, n)
            },
            keyup: function(e) {
                var i = t(e.target).data("ui-slider-handle-index");
                this._keySliding && (this._keySliding = !1, this._stop(e, i), this._change(e, i), t(e.target).removeClass("ui-state-active"))
            }
        }
    }), t.widget("ui.sortable", t.ui.mouse, {
        version: "1.11.0",
        widgetEventPrefix: "sort",
        ready: !1,
        options: {
            appendTo: "parent",
            axis: !1,
            connectWith: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            dropOnEmpty: !0,
            forcePlaceholderSize: !1,
            forceHelperSize: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            items: "> *",
            opacity: !1,
            placeholder: !1,
            revert: !1,
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            scope: "default",
            tolerance: "intersect",
            zIndex: 1e3,
            activate: null,
            beforeStop: null,
            change: null,
            deactivate: null,
            out: null,
            over: null,
            receive: null,
            remove: null,
            sort: null,
            start: null,
            stop: null,
            update: null
        },
        _isOverAxis: function(t, e, i) {
            return t >= e && e + i > t
        },
        _isFloating: function(t) {
            return /left|right/.test(t.css("float")) || /inline|table-cell/.test(t.css("display"))
        },
        _create: function() {
            var t = this.options;
            this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), this.floating = this.items.length ? "x" === t.axis || this._isFloating(this.items[0].item) : !1, this.offset = this.element.offset(), this._mouseInit(), this._setHandleClassName(), this.ready = !0
        },
        _setOption: function(t, e) {
            this._super(t, e), "handle" === t && this._setHandleClassName()
        },
        _setHandleClassName: function() {
            this.element.find(".ui-sortable-handle").removeClass("ui-sortable-handle"), t.each(this.items, function() {
                (this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item).addClass("ui-sortable-handle")
            })
        },
        _destroy: function() {
            this.element.removeClass("ui-sortable ui-sortable-disabled").find(".ui-sortable-handle").removeClass("ui-sortable-handle"), this._mouseDestroy();
            for (var t = this.items.length - 1; t >= 0; t--) this.items[t].item.removeData(this.widgetName + "-item");
            return this
        },
        _mouseCapture: function(e, i) {
            var s = null,
                n = !1,
                o = this;
            return this.reverting ? !1 : this.options.disabled || "static" === this.options.type ? !1 : (this._refreshItems(e), t(e.target).parents().each(function() {
                return t.data(this, o.widgetName + "-item") === o ? (s = t(this), !1) : void 0
            }), t.data(e.target, o.widgetName + "-item") === o && (s = t(e.target)), s && (!this.options.handle || i || (t(this.options.handle, s).find("*").addBack().each(function() {
                this === e.target && (n = !0)
            }), n)) ? (this.currentItem = s, this._removeCurrentsFromItems(), !0) : !1)
        },
        _mouseStart: function(e, i, s) {
            var n, o, a = this.options;
            if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(e), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                    top: this.offset.top - this.margins.top,
                    left: this.offset.left - this.margins.left
                }, t.extend(this.offset, {
                    click: {
                        left: e.pageX - this.offset.left,
                        top: e.pageY - this.offset.top
                    },
                    parent: this._getParentOffset(),
                    relative: this._getRelativeOffset()
                }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(e), this.originalPageX = e.pageX, this.originalPageY = e.pageY, a.cursorAt && this._adjustOffsetFromHelper(a.cursorAt), this.domPosition = {
                    prev: this.currentItem.prev()[0],
                    parent: this.currentItem.parent()[0]
                }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), a.containment && this._setContainment(), a.cursor && "auto" !== a.cursor && (o = this.document.find("body"), this.storedCursor = o.css("cursor"), o.css("cursor", a.cursor), this.storedStylesheet = t("<style>*{ cursor: " + a.cursor + " !important; }</style>").appendTo(o)), a.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", a.opacity)), a.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", a.zIndex)), this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", e, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !s)
                for (n = this.containers.length - 1; n >= 0; n--) this.containers[n]._trigger("activate", e, this._uiHash(this));
            return t.ui.ddmanager && (t.ui.ddmanager.current = this), t.ui.ddmanager && !a.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(e), !0
        },
        _mouseDrag: function(e) {
            var i, s, n, o, a = this.options,
                r = !1;
            for (this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - e.pageY < a.scrollSensitivity ? this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop + a.scrollSpeed : e.pageY - this.overflowOffset.top < a.scrollSensitivity && (this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop - a.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - e.pageX < a.scrollSensitivity ? this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft + a.scrollSpeed : e.pageX - this.overflowOffset.left < a.scrollSensitivity && (this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft - a.scrollSpeed)) : (e.pageY - t(document).scrollTop() < a.scrollSensitivity ? r = t(document).scrollTop(t(document).scrollTop() - a.scrollSpeed) : t(window).height() - (e.pageY - t(document).scrollTop()) < a.scrollSensitivity && (r = t(document).scrollTop(t(document).scrollTop() + a.scrollSpeed)), e.pageX - t(document).scrollLeft() < a.scrollSensitivity ? r = t(document).scrollLeft(t(document).scrollLeft() - a.scrollSpeed) : t(window).width() - (e.pageX - t(document).scrollLeft()) < a.scrollSensitivity && (r = t(document).scrollLeft(t(document).scrollLeft() + a.scrollSpeed))), r !== !1 && t.ui.ddmanager && !a.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), i = this.items.length - 1; i >= 0; i--)
                if (s = this.items[i], n = s.item[0], o = this._intersectsWithPointer(s), o && s.instance === this.currentContainer && n !== this.currentItem[0] && this.placeholder[1 === o ? "next" : "prev"]()[0] !== n && !t.contains(this.placeholder[0], n) && ("semi-dynamic" === this.options.type ? !t.contains(this.element[0], n) : !0)) {
                    if (this.direction = 1 === o ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(s)) break;
                    this._rearrange(e, s), this._trigger("change", e, this._uiHash());
                    break
                }
            return this._contactContainers(e), t.ui.ddmanager && t.ui.ddmanager.drag(this, e), this._trigger("sort", e, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
        },
        _mouseStop: function(e, i) {
            if (e) {
                if (t.ui.ddmanager && !this.options.dropBehaviour && t.ui.ddmanager.drop(this, e), this.options.revert) {
                    var s = this,
                        n = this.placeholder.offset(),
                        o = this.options.axis,
                        a = {};
                    o && "x" !== o || (a.left = n.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft)), o && "y" !== o || (a.top = n.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, t(this.helper).animate(a, parseInt(this.options.revert, 10) || 500, function() {
                        s._clear(e)
                    })
                } else this._clear(e, i);
                return !1
            }
        },
        cancel: function() {
            if (this.dragging) {
                this._mouseUp({
                    target: null
                }), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                for (var e = this.containers.length - 1; e >= 0; e--) this.containers[e]._trigger("deactivate", null, this._uiHash(this)), this.containers[e].containerCache.over && (this.containers[e]._trigger("out", null, this._uiHash(this)), this.containers[e].containerCache.over = 0)
            }
            return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), t.extend(this, {
                helper: null,
                dragging: !1,
                reverting: !1,
                _noFinalSort: null
            }), this.domPosition.prev ? t(this.domPosition.prev).after(this.currentItem) : t(this.domPosition.parent).prepend(this.currentItem)), this
        },
        serialize: function(e) {
            var i = this._getItemsAsjQuery(e && e.connected),
                s = [];
            return e = e || {}, t(i).each(function() {
                var i = (t(e.item || this).attr(e.attribute || "id") || "").match(e.expression || /(.+)[\-=_](.+)/);
                i && s.push((e.key || i[1] + "[]") + "=" + (e.key && e.expression ? i[1] : i[2]))
            }), !s.length && e.key && s.push(e.key + "="), s.join("&")
        },
        toArray: function(e) {
            var i = this._getItemsAsjQuery(e && e.connected),
                s = [];
            return e = e || {}, i.each(function() {
                s.push(t(e.item || this).attr(e.attribute || "id") || "")
            }), s
        },
        _intersectsWith: function(t) {
            var e = this.positionAbs.left,
                i = e + this.helperProportions.width,
                s = this.positionAbs.top,
                n = s + this.helperProportions.height,
                o = t.left,
                a = o + t.width,
                r = t.top,
                h = r + t.height,
                l = this.offset.click.top,
                c = this.offset.click.left,
                u = "x" === this.options.axis || s + l > r && h > s + l,
                d = "y" === this.options.axis || e + c > o && a > e + c,
                p = u && d;
            return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > t[this.floating ? "width" : "height"] ? p : o < e + this.helperProportions.width / 2 && i - this.helperProportions.width / 2 < a && r < s + this.helperProportions.height / 2 && n - this.helperProportions.height / 2 < h
        },
        _intersectsWithPointer: function(t) {
            var e = "x" === this.options.axis || this._isOverAxis(this.positionAbs.top + this.offset.click.top, t.top, t.height),
                i = "y" === this.options.axis || this._isOverAxis(this.positionAbs.left + this.offset.click.left, t.left, t.width),
                s = e && i,
                n = this._getDragVerticalDirection(),
                o = this._getDragHorizontalDirection();
            return s ? this.floating ? o && "right" === o || "down" === n ? 2 : 1 : n && ("down" === n ? 2 : 1) : !1
        },
        _intersectsWithSides: function(t) {
            var e = this._isOverAxis(this.positionAbs.top + this.offset.click.top, t.top + t.height / 2, t.height),
                i = this._isOverAxis(this.positionAbs.left + this.offset.click.left, t.left + t.width / 2, t.width),
                s = this._getDragVerticalDirection(),
                n = this._getDragHorizontalDirection();
            return this.floating && n ? "right" === n && i || "left" === n && !i : s && ("down" === s && e || "up" === s && !e)
        },
        _getDragVerticalDirection: function() {
            var t = this.positionAbs.top - this.lastPositionAbs.top;
            return 0 !== t && (t > 0 ? "down" : "up")
        },
        _getDragHorizontalDirection: function() {
            var t = this.positionAbs.left - this.lastPositionAbs.left;
            return 0 !== t && (t > 0 ? "right" : "left")
        },
        refresh: function(t) {
            return this._refreshItems(t), this._setHandleClassName(), this.refreshPositions(), this
        },
        _connectWith: function() {
            var t = this.options;
            return t.connectWith.constructor === String ? [t.connectWith] : t.connectWith
        },
        _getItemsAsjQuery: function(e) {
            function i() {
                r.push(this)
            }
            var s, n, o, a, r = [],
                h = [],
                l = this._connectWith();
            if (l && e)
                for (s = l.length - 1; s >= 0; s--)
                    for (o = t(l[s]), n = o.length - 1; n >= 0; n--) a = t.data(o[n], this.widgetFullName), a && a !== this && !a.options.disabled && h.push([t.isFunction(a.options.items) ? a.options.items.call(a.element) : t(a.options.items, a.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), a]);
            for (h.push([t.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                    options: this.options,
                    item: this.currentItem
                }) : t(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), s = h.length - 1; s >= 0; s--) h[s][0].each(i);
            return t(r)
        },
        _removeCurrentsFromItems: function() {
            var e = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = t.grep(this.items, function(t) {
                for (var i = 0; i < e.length; i++)
                    if (e[i] === t.item[0]) return !1;
                return !0
            })
        },
        _refreshItems: function(e) {
            this.items = [], this.containers = [this];
            var i, s, n, o, a, r, h, l, c = this.items,
                u = [
                    [t.isFunction(this.options.items) ? this.options.items.call(this.element[0], e, {
                        item: this.currentItem
                    }) : t(this.options.items, this.element), this]
                ],
                d = this._connectWith();
            if (d && this.ready)
                for (i = d.length - 1; i >= 0; i--)
                    for (n = t(d[i]), s = n.length - 1; s >= 0; s--) o = t.data(n[s], this.widgetFullName), o && o !== this && !o.options.disabled && (u.push([t.isFunction(o.options.items) ? o.options.items.call(o.element[0], e, {
                        item: this.currentItem
                    }) : t(o.options.items, o.element), o]), this.containers.push(o));
            for (i = u.length - 1; i >= 0; i--)
                for (a = u[i][1], r = u[i][0], s = 0, l = r.length; l > s; s++) h = t(r[s]), h.data(this.widgetName + "-item", a), c.push({
                    item: h,
                    instance: a,
                    width: 0,
                    height: 0,
                    left: 0,
                    top: 0
                })
        },
        refreshPositions: function(e) {
            this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
            var i, s, n, o;
            for (i = this.items.length - 1; i >= 0; i--) s = this.items[i], s.instance !== this.currentContainer && this.currentContainer && s.item[0] !== this.currentItem[0] || (n = this.options.toleranceElement ? t(this.options.toleranceElement, s.item) : s.item, e || (s.width = n.outerWidth(), s.height = n.outerHeight()), o = n.offset(), s.left = o.left, s.top = o.top);
            if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);
            else
                for (i = this.containers.length - 1; i >= 0; i--) o = this.containers[i].element.offset(), this.containers[i].containerCache.left = o.left, this.containers[i].containerCache.top = o.top, this.containers[i].containerCache.width = this.containers[i].element.outerWidth(), this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
            return this
        },
        _createPlaceholder: function(e) {
            e = e || this;
            var i, s = e.options;
            s.placeholder && s.placeholder.constructor !== String || (i = s.placeholder, s.placeholder = {
                element: function() {
                    var s = e.currentItem[0].nodeName.toLowerCase(),
                        n = t("<" + s + ">", e.document[0]).addClass(i || e.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                    return "tr" === s ? e.currentItem.children().each(function() {
                        t("<td>&#160;</td>", e.document[0]).attr("colspan", t(this).attr("colspan") || 1).appendTo(n)
                    }) : "img" === s && n.attr("src", e.currentItem.attr("src")), i || n.css("visibility", "hidden"), n
                },
                update: function(t, n) {
                    (!i || s.forcePlaceholderSize) && (n.height() || n.height(e.currentItem.innerHeight() - parseInt(e.currentItem.css("paddingTop") || 0, 10) - parseInt(e.currentItem.css("paddingBottom") || 0, 10)), n.width() || n.width(e.currentItem.innerWidth() - parseInt(e.currentItem.css("paddingLeft") || 0, 10) - parseInt(e.currentItem.css("paddingRight") || 0, 10)))
                }
            }), e.placeholder = t(s.placeholder.element.call(e.element, e.currentItem)), e.currentItem.after(e.placeholder), s.placeholder.update(e, e.placeholder)
        },
        _contactContainers: function(e) {
            var i, s, n, o, a, r, h, l, c, u, d = null,
                p = null;
            for (i = this.containers.length - 1; i >= 0; i--)
                if (!t.contains(this.currentItem[0], this.containers[i].element[0]))
                    if (this._intersectsWith(this.containers[i].containerCache)) {
                        if (d && t.contains(this.containers[i].element[0], d.element[0])) continue;
                        d = this.containers[i], p = i
                    } else this.containers[i].containerCache.over && (this.containers[i]._trigger("out", e, this._uiHash(this)), this.containers[i].containerCache.over = 0);
            if (d)
                if (1 === this.containers.length) this.containers[p].containerCache.over || (this.containers[p]._trigger("over", e, this._uiHash(this)), this.containers[p].containerCache.over = 1);
                else {
                    for (n = 1e4, o = null, c = d.floating || this._isFloating(this.currentItem), a = c ? "left" : "top", r = c ? "width" : "height", u = c ? "clientX" : "clientY", s = this.items.length - 1; s >= 0; s--) t.contains(this.containers[p].element[0], this.items[s].item[0]) && this.items[s].item[0] !== this.currentItem[0] && (h = this.items[s].item.offset()[a], l = !1, e[u] - h > this.items[s][r] / 2 && (l = !0), Math.abs(e[u] - h) < n && (n = Math.abs(e[u] - h), o = this.items[s], this.direction = l ? "up" : "down"));
                    if (!o && !this.options.dropOnEmpty) return;
                    if (this.currentContainer === this.containers[p]) return;
                    o ? this._rearrange(e, o, null, !0) : this._rearrange(e, null, this.containers[p].element, !0), this._trigger("change", e, this._uiHash()), this.containers[p]._trigger("change", e, this._uiHash(this)), this.currentContainer = this.containers[p], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[p]._trigger("over", e, this._uiHash(this)), this.containers[p].containerCache.over = 1
                }
        },
        _createHelper: function(e) {
            var i = this.options,
                s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e, this.currentItem])) : "clone" === i.helper ? this.currentItem.clone() : this.currentItem;
            return s.parents("body").length || t("parent" !== i.appendTo ? i.appendTo : this.currentItem[0].parentNode)[0].appendChild(s[0]), s[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width,
                height: this.currentItem[0].style.height,
                position: this.currentItem.css("position"),
                top: this.currentItem.css("top"),
                left: this.currentItem.css("left")
            }), (!s[0].style.width || i.forceHelperSize) && s.width(this.currentItem.width()), (!s[0].style.height || i.forceHelperSize) && s.height(this.currentItem.height()), s
        },
        _adjustOffsetFromHelper: function(e) {
            "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
        },
        _getParentOffset: function() {
            this.offsetParent = this.helper.offsetParent();
            var e = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && t.ui.ie) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function() {
            if ("relative" === this.cssPosition) {
                var t = this.currentItem.position();
                return {
                    top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                }
            }
            return {
                top: 0,
                left: 0
            }
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                top: parseInt(this.currentItem.css("marginTop"), 10) || 0
            }
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function() {
            var e, i, s, n = this.options;
            "parent" === n.containment && (n.containment = this.helper[0].parentNode), ("document" === n.containment || "window" === n.containment) && (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, t("document" === n.containment ? document : window).width() - this.helperProportions.width - this.margins.left, (t("document" === n.containment ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(n.containment) || (e = t(n.containment)[0], i = t(n.containment).offset(), s = "hidden" !== t(e).css("overflow"), this.containment = [i.left + (parseInt(t(e).css("borderLeftWidth"), 10) || 0) + (parseInt(t(e).css("paddingLeft"), 10) || 0) - this.margins.left, i.top + (parseInt(t(e).css("borderTopWidth"), 10) || 0) + (parseInt(t(e).css("paddingTop"), 10) || 0) - this.margins.top, i.left + (s ? Math.max(e.scrollWidth, e.offsetWidth) : e.offsetWidth) - (parseInt(t(e).css("borderLeftWidth"), 10) || 0) - (parseInt(t(e).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, i.top + (s ? Math.max(e.scrollHeight, e.offsetHeight) : e.offsetHeight) - (parseInt(t(e).css("borderTopWidth"), 10) || 0) - (parseInt(t(e).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
        },
        _convertPositionTo: function(e, i) {
            i || (i = this.position);
            var s = "absolute" === e ? 1 : -1,
                n = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                o = /(html|body)/i.test(n[0].tagName);
            return {
                top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : o ? 0 : n.scrollTop()) * s,
                left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : o ? 0 : n.scrollLeft()) * s
            }
        },
        _generatePosition: function(e) {
            var i, s, n = this.options,
                o = e.pageX,
                a = e.pageY,
                r = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                h = /(html|body)/i.test(r[0].tagName);
            return "relative" !== this.cssPosition || this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (e.pageX - this.offset.click.left < this.containment[0] && (o = this.containment[0] + this.offset.click.left), e.pageY - this.offset.click.top < this.containment[1] && (a = this.containment[1] + this.offset.click.top), e.pageX - this.offset.click.left > this.containment[2] && (o = this.containment[2] + this.offset.click.left), e.pageY - this.offset.click.top > this.containment[3] && (a = this.containment[3] + this.offset.click.top)), n.grid && (i = this.originalPageY + Math.round((a - this.originalPageY) / n.grid[1]) * n.grid[1], a = this.containment ? i - this.offset.click.top >= this.containment[1] && i - this.offset.click.top <= this.containment[3] ? i : i - this.offset.click.top >= this.containment[1] ? i - n.grid[1] : i + n.grid[1] : i, s = this.originalPageX + Math.round((o - this.originalPageX) / n.grid[0]) * n.grid[0], o = this.containment ? s - this.offset.click.left >= this.containment[0] && s - this.offset.click.left <= this.containment[2] ? s : s - this.offset.click.left >= this.containment[0] ? s - n.grid[0] : s + n.grid[0] : s)), {
                top: a - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : h ? 0 : r.scrollTop()),
                left: o - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : h ? 0 : r.scrollLeft())
            }
        },
        _rearrange: function(t, e, i, s) {
            i ? i[0].appendChild(this.placeholder[0]) : e.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? e.item[0] : e.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
            var n = this.counter;
            this._delay(function() {
                n === this.counter && this.refreshPositions(!s)
            })
        },
        _clear: function(t, e) {
            function i(t, e, i) {
                return function(s) {
                    i._trigger(t, s, e._uiHash(e))
                }
            }
            this.reverting = !1;
            var s, n = [];
            if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                for (s in this._storedCSS)("auto" === this._storedCSS[s] || "static" === this._storedCSS[s]) && (this._storedCSS[s] = "");
                this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
            } else this.currentItem.show();
            for (this.fromOutside && !e && n.push(function(t) {
                    this._trigger("receive", t, this._uiHash(this.fromOutside))
                }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || e || n.push(function(t) {
                    this._trigger("update", t, this._uiHash())
                }), this !== this.currentContainer && (e || (n.push(function(t) {
                    this._trigger("remove", t, this._uiHash())
                }), n.push(function(t) {
                    return function(e) {
                        t._trigger("receive", e, this._uiHash(this))
                    }
                }.call(this, this.currentContainer)), n.push(function(t) {
                    return function(e) {
                        t._trigger("update", e, this._uiHash(this))
                    }
                }.call(this, this.currentContainer)))), s = this.containers.length - 1; s >= 0; s--) e || n.push(i("deactivate", this, this.containers[s])), this.containers[s].containerCache.over && (n.push(i("out", this, this.containers[s])), this.containers[s].containerCache.over = 0);
            if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, this.cancelHelperRemoval) {
                if (!e) {
                    for (this._trigger("beforeStop", t, this._uiHash()), s = 0; s < n.length; s++) n[s].call(this, t);
                    this._trigger("stop", t, this._uiHash())
                }
                return this.fromOutside = !1, !1
            }
            if (e || this._trigger("beforeStop", t, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null, !e) {
                for (s = 0; s < n.length; s++) n[s].call(this, t);
                this._trigger("stop", t, this._uiHash())
            }
            return this.fromOutside = !1, !0
        },
        _trigger: function() {
            t.Widget.prototype._trigger.apply(this, arguments) === !1 && this.cancel()
        },
        _uiHash: function(e) {
            var i = e || this;
            return {
                helper: i.helper,
                placeholder: i.placeholder || t([]),
                position: i.position,
                originalPosition: i.originalPosition,
                offset: i.positionAbs,
                item: i.currentItem,
                sender: e ? e.element : null
            }
        }
    }), t.widget("ui.spinner", {
        version: "1.11.0",
        defaultElement: "<input>",
        widgetEventPrefix: "spin",
        options: {
            culture: null,
            icons: {
                down: "ui-icon-triangle-1-s",
                up: "ui-icon-triangle-1-n"
            },
            incremental: !0,
            max: null,
            min: null,
            numberFormat: null,
            page: 10,
            step: 1,
            change: null,
            spin: null,
            start: null,
            stop: null
        },
        _create: function() {
            this._setOption("max", this.options.max), this._setOption("min", this.options.min), this._setOption("step", this.options.step), "" !== this.value() && this._value(this.element.val(), !0), this._draw(), this._on(this._events), this._refresh(), this._on(this.window, {
                beforeunload: function() {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _getCreateOptions: function() {
            var e = {},
                i = this.element;
            return t.each(["min", "max", "step"], function(t, s) {
                var n = i.attr(s);
                void 0 !== n && n.length && (e[s] = n)
            }), e
        },
        _events: {
            keydown: function(t) {
                this._start(t) && this._keydown(t) && t.preventDefault()
            },
            keyup: "_stop",
            focus: function() {
                this.previous = this.element.val()
            },
            blur: function(t) {
                return this.cancelBlur ? void delete this.cancelBlur : (this._stop(), this._refresh(), void(this.previous !== this.element.val() && this._trigger("change", t)))
            },
            mousewheel: function(t, e) {
                if (e) {
                    if (!this.spinning && !this._start(t)) return !1;
                    this._spin((e > 0 ? 1 : -1) * this.options.step, t), clearTimeout(this.mousewheelTimer), this.mousewheelTimer = this._delay(function() {
                        this.spinning && this._stop(t)
                    }, 100), t.preventDefault()
                }
            },
            "mousedown .ui-spinner-button": function(e) {
                function i() {
                    var t = this.element[0] === this.document[0].activeElement;
                    t || (this.element.focus(), this.previous = s, this._delay(function() {
                        this.previous = s
                    }))
                }
                var s;
                s = this.element[0] === this.document[0].activeElement ? this.previous : this.element.val(), e.preventDefault(), i.call(this), this.cancelBlur = !0, this._delay(function() {
                    delete this.cancelBlur, i.call(this)
                }), this._start(e) !== !1 && this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e)
            },
            "mouseup .ui-spinner-button": "_stop",
            "mouseenter .ui-spinner-button": function(e) {
                return t(e.currentTarget).hasClass("ui-state-active") ? this._start(e) === !1 ? !1 : void this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e) : void 0
            },
            "mouseleave .ui-spinner-button": "_stop"
        },
        _draw: function() {
            var t = this.uiSpinner = this.element.addClass("ui-spinner-input").attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml());
            this.element.attr("role", "spinbutton"), this.buttons = t.find(".ui-spinner-button").attr("tabIndex", -1).button().removeClass("ui-corner-all"), this.buttons.height() > Math.ceil(.5 * t.height()) && t.height() > 0 && t.height(t.height()), this.options.disabled && this.disable()
        },
        _keydown: function(e) {
            var i = this.options,
                s = t.ui.keyCode;
            switch (e.keyCode) {
                case s.UP:
                    return this._repeat(null, 1, e), !0;
                case s.DOWN:
                    return this._repeat(null, -1, e), !0;
                case s.PAGE_UP:
                    return this._repeat(null, i.page, e), !0;
                case s.PAGE_DOWN:
                    return this._repeat(null, -i.page, e), !0
            }
            return !1
        },
        _uiSpinnerHtml: function() {
            return "<span class='ui-spinner ui-widget ui-widget-content ui-corner-all'></span>"
        },
        _buttonHtml: function() {
            return "<a class='ui-spinner-button ui-spinner-up ui-corner-tr'><span class='ui-icon " + this.options.icons.up + "'>&#9650;</span></a><a class='ui-spinner-button ui-spinner-down ui-corner-br'><span class='ui-icon " + this.options.icons.down + "'>&#9660;</span></a>"
        },
        _start: function(t) {
            return this.spinning || this._trigger("start", t) !== !1 ? (this.counter || (this.counter = 1), this.spinning = !0, !0) : !1
        },
        _repeat: function(t, e, i) {
            t = t || 500, clearTimeout(this.timer), this.timer = this._delay(function() {
                this._repeat(40, e, i)
            }, t), this._spin(e * this.options.step, i)
        },
        _spin: function(t, e) {
            var i = this.value() || 0;
            this.counter || (this.counter = 1), i = this._adjustValue(i + t * this._increment(this.counter)), this.spinning && this._trigger("spin", e, {
                value: i
            }) === !1 || (this._value(i), this.counter++)
        },
        _increment: function(e) {
            var i = this.options.incremental;
            return i ? t.isFunction(i) ? i(e) : Math.floor(e * e * e / 5e4 - e * e / 500 + 17 * e / 200 + 1) : 1
        },
        _precision: function() {
            var t = this._precisionOf(this.options.step);
            return null !== this.options.min && (t = Math.max(t, this._precisionOf(this.options.min))), t
        },
        _precisionOf: function(t) {
            var e = t.toString(),
                i = e.indexOf(".");
            return -1 === i ? 0 : e.length - i - 1
        },
        _adjustValue: function(t) {
            var e, i, s = this.options;
            return e = null !== s.min ? s.min : 0, i = t - e, i = Math.round(i / s.step) * s.step, t = e + i, t = parseFloat(t.toFixed(this._precision())), null !== s.max && t > s.max ? s.max : null !== s.min && t < s.min ? s.min : t
        },
        _stop: function(t) {
            this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), this.counter = 0, this.spinning = !1, this._trigger("stop", t))
        },
        _setOption: function(t, e) {
            if ("culture" === t || "numberFormat" === t) {
                var i = this._parse(this.element.val());
                return this.options[t] = e, void this.element.val(this._format(i))
            }("max" === t || "min" === t || "step" === t) && "string" == typeof e && (e = this._parse(e)), "icons" === t && (this.buttons.first().find(".ui-icon").removeClass(this.options.icons.up).addClass(e.up), this.buttons.last().find(".ui-icon").removeClass(this.options.icons.down).addClass(e.down)), this._super(t, e), "disabled" === t && (this.widget().toggleClass("ui-state-disabled", !!e), this.element.prop("disabled", !!e), this.buttons.button(e ? "disable" : "enable"))
        },
        _setOptions: r(function(t) {
            this._super(t)
        }),
        _parse: function(t) {
            return "string" == typeof t && "" !== t && (t = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(t, 10, this.options.culture) : +t), "" === t || isNaN(t) ? null : t
        },
        _format: function(t) {
            return "" === t ? "" : window.Globalize && this.options.numberFormat ? Globalize.format(t, this.options.numberFormat, this.options.culture) : t
        },
        _refresh: function() {
            this.element.attr({
                "aria-valuemin": this.options.min,
                "aria-valuemax": this.options.max,
                "aria-valuenow": this._parse(this.element.val())
            })
        },
        isValid: function() {
            var t = this.value();
            return null === t ? !1 : t === this._adjustValue(t)
        },
        _value: function(t, e) {
            var i;
            "" !== t && (i = this._parse(t), null !== i && (e || (i = this._adjustValue(i)), t = this._format(i))), this.element.val(t), this._refresh()
        },
        _destroy: function() {
            this.element.removeClass("ui-spinner-input").prop("disabled", !1).removeAttr("autocomplete").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.uiSpinner.replaceWith(this.element)
        },
        stepUp: r(function(t) {
            this._stepUp(t)
        }),
        _stepUp: function(t) {
            this._start() && (this._spin((t || 1) * this.options.step), this._stop())
        },
        stepDown: r(function(t) {
            this._stepDown(t)
        }),
        _stepDown: function(t) {
            this._start() && (this._spin((t || 1) * -this.options.step), this._stop())
        },
        pageUp: r(function(t) {
            this._stepUp((t || 1) * this.options.page)
        }),
        pageDown: r(function(t) {
            this._stepDown((t || 1) * this.options.page)
        }),
        value: function(t) {
            return arguments.length ? void r(this._value).call(this, t) : this._parse(this.element.val())
        },
        widget: function() {
            return this.uiSpinner
        }
    }), t.widget("ui.tabs", {
        version: "1.11.0",
        delay: 300,
        options: {
            active: null,
            collapsible: !1,
            event: "click",
            heightStyle: "content",
            hide: null,
            show: null,
            activate: null,
            beforeActivate: null,
            beforeLoad: null,
            load: null
        },
        _isLocal: function() {
            var t = /#.*$/;
            return function(e) {
                var i, s;
                e = e.cloneNode(!1), i = e.href.replace(t, ""), s = location.href.replace(t, "");
                try {
                    i = decodeURIComponent(i)
                } catch (n) {}
                try {
                    s = decodeURIComponent(s)
                } catch (n) {}
                return e.hash.length > 1 && i === s
            }
        }(),
        _create: function() {
            var e = this,
                i = this.options;
            this.running = !1, this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible", i.collapsible).delegate(".ui-tabs-nav > li", "mousedown" + this.eventNamespace, function(e) {
                t(this).is(".ui-state-disabled") && e.preventDefault()
            }).delegate(".ui-tabs-anchor", "focus" + this.eventNamespace, function() {
                t(this).closest("li").is(".ui-state-disabled") && this.blur()
            }), this._processTabs(), i.active = this._initialActive(), t.isArray(i.disabled) && (i.disabled = t.unique(i.disabled.concat(t.map(this.tabs.filter(".ui-state-disabled"), function(t) {
                return e.tabs.index(t)
            }))).sort()), this.options.active !== !1 && this.anchors.length ? this.active = this._findActive(i.active) : this.active = t(), this._refresh(), this.active.length && this.load(i.active)
        },
        _initialActive: function() {
            var e = this.options.active,
                i = this.options.collapsible,
                s = location.hash.substring(1);
            return null === e && (s && this.tabs.each(function(i, n) {
                return t(n).attr("aria-controls") === s ? (e = i, !1) : void 0
            }), null === e && (e = this.tabs.index(this.tabs.filter(".ui-tabs-active"))), (null === e || -1 === e) && (e = this.tabs.length ? 0 : !1)), e !== !1 && (e = this.tabs.index(this.tabs.eq(e)), -1 === e && (e = i ? !1 : 0)), !i && e === !1 && this.anchors.length && (e = 0), e
        },
        _getCreateEventData: function() {
            return {
                tab: this.active,
                panel: this.active.length ? this._getPanelForTab(this.active) : t()
            }
        },
        _tabKeydown: function(e) {
            var i = t(this.document[0].activeElement).closest("li"),
                s = this.tabs.index(i),
                n = !0;
            if (!this._handlePageNav(e)) {
                switch (e.keyCode) {
                    case t.ui.keyCode.RIGHT:
                    case t.ui.keyCode.DOWN:
                        s++;
                        break;
                    case t.ui.keyCode.UP:
                    case t.ui.keyCode.LEFT:
                        n = !1, s--;
                        break;
                    case t.ui.keyCode.END:
                        s = this.anchors.length - 1;
                        break;
                    case t.ui.keyCode.HOME:
                        s = 0;
                        break;
                    case t.ui.keyCode.SPACE:
                        return e.preventDefault(), clearTimeout(this.activating), void this._activate(s);
                    case t.ui.keyCode.ENTER:
                        return e.preventDefault(), clearTimeout(this.activating), void this._activate(s === this.options.active ? !1 : s);
                    default:
                        return
                }
                e.preventDefault(), clearTimeout(this.activating), s = this._focusNextTab(s, n), e.ctrlKey || (i.attr("aria-selected", "false"), this.tabs.eq(s).attr("aria-selected", "true"), this.activating = this._delay(function() {
                    this.option("active", s)
                }, this.delay))
            }
        },
        _panelKeydown: function(e) {
            this._handlePageNav(e) || e.ctrlKey && e.keyCode === t.ui.keyCode.UP && (e.preventDefault(), this.active.focus())
        },
        _handlePageNav: function(e) {
            return e.altKey && e.keyCode === t.ui.keyCode.PAGE_UP ? (this._activate(this._focusNextTab(this.options.active - 1, !1)), !0) : e.altKey && e.keyCode === t.ui.keyCode.PAGE_DOWN ? (this._activate(this._focusNextTab(this.options.active + 1, !0)), !0) : void 0
        },
        _findNextTab: function(e, i) {
            function s() {
                return e > n && (e = 0), 0 > e && (e = n), e
            }
            for (var n = this.tabs.length - 1; - 1 !== t.inArray(s(), this.options.disabled);) e = i ? e + 1 : e - 1;
            return e
        },
        _focusNextTab: function(t, e) {
            return t = this._findNextTab(t, e), this.tabs.eq(t).focus(), t
        },
        _setOption: function(t, e) {
            return "active" === t ? void this._activate(e) : "disabled" === t ? void this._setupDisabled(e) : (this._super(t, e), "collapsible" === t && (this.element.toggleClass("ui-tabs-collapsible", e), e || this.options.active !== !1 || this._activate(0)), "event" === t && this._setupEvents(e), void("heightStyle" === t && this._setupHeightStyle(e)))
        },
        _sanitizeSelector: function(t) {
            return t ? t.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&") : ""
        },
        refresh: function() {
            var e = this.options,
                i = this.tablist.children(":has(a[href])");
            e.disabled = t.map(i.filter(".ui-state-disabled"), function(t) {
                return i.index(t)
            }), this._processTabs(), e.active !== !1 && this.anchors.length ? this.active.length && !t.contains(this.tablist[0], this.active[0]) ? this.tabs.length === e.disabled.length ? (e.active = !1, this.active = t()) : this._activate(this._findNextTab(Math.max(0, e.active - 1), !1)) : e.active = this.tabs.index(this.active) : (e.active = !1, this.active = t()), this._refresh()
        },
        _refresh: function() {
            this._setupDisabled(this.options.disabled), this._setupEvents(this.options.event), this._setupHeightStyle(this.options.heightStyle), this.tabs.not(this.active).attr({
                "aria-selected": "false",
                "aria-expanded": "false",
                tabIndex: -1
            }), this.panels.not(this._getPanelForTab(this.active)).hide().attr({
                "aria-hidden": "true"
            }), this.active.length ? (this.active.addClass("ui-tabs-active ui-state-active").attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            }), this._getPanelForTab(this.active).show().attr({
                "aria-hidden": "false"
            })) : this.tabs.eq(0).attr("tabIndex", 0)
        },
        _processTabs: function() {
            var e = this;
            this.tablist = this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role", "tablist"), this.tabs = this.tablist.find("> li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({
                role: "tab",
                tabIndex: -1
            }), this.anchors = this.tabs.map(function() {
                return t("a", this)[0]
            }).addClass("ui-tabs-anchor").attr({
                role: "presentation",
                tabIndex: -1
            }), this.panels = t(), this.anchors.each(function(i, s) {
                var n, o, a, r = t(s).uniqueId().attr("id"),
                    h = t(s).closest("li"),
                    l = h.attr("aria-controls");
                e._isLocal(s) ? (n = s.hash, a = n.substring(1), o = e.element.find(e._sanitizeSelector(n))) : (a = h.attr("aria-controls") || t({}).uniqueId()[0].id, n = "#" + a, o = e.element.find(n), o.length || (o = e._createPanel(a), o.insertAfter(e.panels[i - 1] || e.tablist)), o.attr("aria-live", "polite")), o.length && (e.panels = e.panels.add(o)), l && h.data("ui-tabs-aria-controls", l), h.attr({
                    "aria-controls": a,
                    "aria-labelledby": r
                }), o.attr("aria-labelledby", r)
            }), this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role", "tabpanel")
        },
        _getList: function() {
            return this.tablist || this.element.find("ol,ul").eq(0)
        },
        _createPanel: function(e) {
            return t("<div>").attr("id", e).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy", !0)
        },
        _setupDisabled: function(e) {
            t.isArray(e) && (e.length ? e.length === this.anchors.length && (e = !0) : e = !1);
            for (var i, s = 0; i = this.tabs[s]; s++) e === !0 || -1 !== t.inArray(s, e) ? t(i).addClass("ui-state-disabled").attr("aria-disabled", "true") : t(i).removeClass("ui-state-disabled").removeAttr("aria-disabled");
            this.options.disabled = e
        },
        _setupEvents: function(e) {
            var i = {};
            e && t.each(e.split(" "), function(t, e) {
                i[e] = "_eventHandler"
            }), this._off(this.anchors.add(this.tabs).add(this.panels)), this._on(!0, this.anchors, {
                click: function(t) {
                    t.preventDefault()
                }
            }), this._on(this.anchors, i), this._on(this.tabs, {
                keydown: "_tabKeydown"
            }), this._on(this.panels, {
                keydown: "_panelKeydown"
            }), this._focusable(this.tabs), this._hoverable(this.tabs)
        },
        _setupHeightStyle: function(e) {
            var i, s = this.element.parent();
            "fill" === e ? (i = s.height(), i -= this.element.outerHeight() - this.element.height(), this.element.siblings(":visible").each(function() {
                var e = t(this),
                    s = e.css("position");
                "absolute" !== s && "fixed" !== s && (i -= e.outerHeight(!0))
            }), this.element.children().not(this.panels).each(function() {
                i -= t(this).outerHeight(!0)
            }), this.panels.each(function() {
                t(this).height(Math.max(0, i - t(this).innerHeight() + t(this).height()))
            }).css("overflow", "auto")) : "auto" === e && (i = 0, this.panels.each(function() {
                i = Math.max(i, t(this).height("").height())
            }).height(i))
        },
        _eventHandler: function(e) {
            var i = this.options,
                s = this.active,
                n = t(e.currentTarget),
                o = n.closest("li"),
                a = o[0] === s[0],
                r = a && i.collapsible,
                h = r ? t() : this._getPanelForTab(o),
                l = s.length ? this._getPanelForTab(s) : t(),
                c = {
                    oldTab: s,
                    oldPanel: l,
                    newTab: r ? t() : o,
                    newPanel: h
                };
            e.preventDefault(), o.hasClass("ui-state-disabled") || o.hasClass("ui-tabs-loading") || this.running || a && !i.collapsible || this._trigger("beforeActivate", e, c) === !1 || (i.active = r ? !1 : this.tabs.index(o), this.active = a ? t() : o, this.xhr && this.xhr.abort(), l.length || h.length || t.error("jQuery UI Tabs: Mismatching fragment identifier."), h.length && this.load(this.tabs.index(o), e), this._toggle(e, c))
        },
        _toggle: function(e, i) {
            function s() {
                o.running = !1, o._trigger("activate", e, i)
            }

            function n() {
                i.newTab.closest("li").addClass("ui-tabs-active ui-state-active"), a.length && o.options.show ? o._show(a, o.options.show, s) : (a.show(), s())
            }
            var o = this,
                a = i.newPanel,
                r = i.oldPanel;
            this.running = !0, r.length && this.options.hide ? this._hide(r, this.options.hide, function() {
                i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), n()
            }) : (i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), r.hide(), n()), r.attr("aria-hidden", "true"), i.oldTab.attr({
                "aria-selected": "false",
                "aria-expanded": "false"
            }), a.length && r.length ? i.oldTab.attr("tabIndex", -1) : a.length && this.tabs.filter(function() {
                return 0 === t(this).attr("tabIndex")
            }).attr("tabIndex", -1), a.attr("aria-hidden", "false"), i.newTab.attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            })
        },
        _activate: function(e) {
            var i, s = this._findActive(e);
            s[0] !== this.active[0] && (s.length || (s = this.active), i = s.find(".ui-tabs-anchor")[0], this._eventHandler({
                target: i,
                currentTarget: i,
                preventDefault: t.noop
            }))
        },
        _findActive: function(e) {
            return e === !1 ? t() : this.tabs.eq(e)
        },
        _getIndex: function(t) {
            return "string" == typeof t && (t = this.anchors.index(this.anchors.filter("[href$='" + t + "']"))), t
        },
        _destroy: function() {
            this.xhr && this.xhr.abort(), this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible"), this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role"), this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId(), this.tabs.add(this.panels).each(function() {
                t.data(this, "ui-tabs-destroy") ? t(this).remove() : t(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role")
            }), this.tabs.each(function() {
                var e = t(this),
                    i = e.data("ui-tabs-aria-controls");
                i ? e.attr("aria-controls", i).removeData("ui-tabs-aria-controls") : e.removeAttr("aria-controls")
            }), this.panels.show(), "content" !== this.options.heightStyle && this.panels.css("height", "")
        },
        enable: function(e) {
            var i = this.options.disabled;
            i !== !1 && (void 0 === e ? i = !1 : (e = this._getIndex(e), i = t.isArray(i) ? t.map(i, function(t) {
                return t !== e ? t : null
            }) : t.map(this.tabs, function(t, i) {
                return i !== e ? i : null
            })), this._setupDisabled(i))
        },
        disable: function(e) {
            var i = this.options.disabled;
            if (i !== !0) {
                if (void 0 === e) i = !0;
                else {
                    if (e = this._getIndex(e), -1 !== t.inArray(e, i)) return;
                    i = t.isArray(i) ? t.merge([e], i).sort() : [e]
                }
                this._setupDisabled(i)
            }
        },
        load: function(e, i) {
            e = this._getIndex(e);
            var s = this,
                n = this.tabs.eq(e),
                o = n.find(".ui-tabs-anchor"),
                a = this._getPanelForTab(n),
                r = {
                    tab: n,
                    panel: a
                };
            this._isLocal(o[0]) || (this.xhr = t.ajax(this._ajaxSettings(o, i, r)), this.xhr && "canceled" !== this.xhr.statusText && (n.addClass("ui-tabs-loading"), a.attr("aria-busy", "true"), this.xhr.success(function(t) {
                setTimeout(function() {
                    a.html(t), s._trigger("load", i, r)
                }, 1)
            }).complete(function(t, e) {
                setTimeout(function() {
                    "abort" === e && s.panels.stop(!1, !0), n.removeClass("ui-tabs-loading"), a.removeAttr("aria-busy"), t === s.xhr && delete s.xhr
                }, 1)
            })))
        },
        _ajaxSettings: function(e, i, s) {
            var n = this;
            return {
                url: e.attr("href"),
                beforeSend: function(e, o) {
                    return n._trigger("beforeLoad", i, t.extend({
                        jqXHR: e,
                        ajaxSettings: o
                    }, s))
                }
            }
        },
        _getPanelForTab: function(e) {
            var i = t(e).attr("aria-controls");
            return this.element.find(this._sanitizeSelector("#" + i))
        }
    }), t.widget("ui.tooltip", {
        version: "1.11.0",
        options: {
            content: function() {
                var e = t(this).attr("title") || "";
                return t("<a>").text(e).html()
            },
            hide: !0,
            items: "[title]:not([disabled])",
            position: {
                my: "left top+15",
                at: "left bottom",
                collision: "flipfit flip"
            },
            show: !0,
            tooltipClass: null,
            track: !1,
            close: null,
            open: null
        },
        _addDescribedBy: function(e, i) {
            var s = (e.attr("aria-describedby") || "").split(/\s+/);
            s.push(i), e.data("ui-tooltip-id", i).attr("aria-describedby", t.trim(s.join(" ")))
        },
        _removeDescribedBy: function(e) {
            var i = e.data("ui-tooltip-id"),
                s = (e.attr("aria-describedby") || "").split(/\s+/),
                n = t.inArray(i, s); - 1 !== n && s.splice(n, 1), e.removeData("ui-tooltip-id"), s = t.trim(s.join(" ")), s ? e.attr("aria-describedby", s) : e.removeAttr("aria-describedby")
        },
        _create: function() {
            this._on({
                mouseover: "open",
                focusin: "open"
            }), this.tooltips = {}, this.parents = {}, this.options.disabled && this._disable(), this.liveRegion = t("<div>").attr({
                role: "log",
                "aria-live": "assertive",
                "aria-relevant": "additions"
            }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body)
        },
        _setOption: function(e, i) {
            var s = this;
            return "disabled" === e ? (this[i ? "_disable" : "_enable"](), void(this.options[e] = i)) : (this._super(e, i), void("content" === e && t.each(this.tooltips, function(t, e) {
                s._updateContent(e)
            })))
        },
        _disable: function() {
            var e = this;
            t.each(this.tooltips, function(i, s) {
                var n = t.Event("blur");
                n.target = n.currentTarget = s[0], e.close(n, !0)
            }), this.element.find(this.options.items).addBack().each(function() {
                var e = t(this);
                e.is("[title]") && e.data("ui-tooltip-title", e.attr("title")).removeAttr("title")
            })
        },
        _enable: function() {
            this.element.find(this.options.items).addBack().each(function() {
                var e = t(this);
                e.data("ui-tooltip-title") && e.attr("title", e.data("ui-tooltip-title"))
            })
        },
        open: function(e) {
            var i = this,
                s = t(e ? e.target : this.element).closest(this.options.items);
            s.length && !s.data("ui-tooltip-id") && (s.attr("title") && s.data("ui-tooltip-title", s.attr("title")), s.data("ui-tooltip-open", !0), e && "mouseover" === e.type && s.parents().each(function() {
                var e, s = t(this);
                s.data("ui-tooltip-open") && (e = t.Event("blur"), e.target = e.currentTarget = this, i.close(e, !0)), s.attr("title") && (s.uniqueId(), i.parents[this.id] = {
                    element: this,
                    title: s.attr("title")
                }, s.attr("title", ""))
            }), this._updateContent(s, e))
        },
        _updateContent: function(t, e) {
            var i, s = this.options.content,
                n = this,
                o = e ? e.type : null;
            return "string" == typeof s ? this._open(e, t, s) : (i = s.call(t[0], function(i) {
                t.data("ui-tooltip-open") && n._delay(function() {
                    e && (e.type = o), this._open(e, t, i)
                })
            }), void(i && this._open(e, t, i)))
        },
        _open: function(e, i, s) {
            function n(t) {
                l.of = t, o.is(":hidden") || o.position(l)
            }
            var o, a, r, h, l = t.extend({}, this.options.position);
            if (s) {
                if (o = this._find(i), o.length) return void o.find(".ui-tooltip-content").html(s);
                i.is("[title]") && (e && "mouseover" === e.type ? i.attr("title", "") : i.removeAttr("title")), o = this._tooltip(i), this._addDescribedBy(i, o.attr("id")), o.find(".ui-tooltip-content").html(s), this.liveRegion.children().hide(), s.clone ? (h = s.clone(), h.removeAttr("id").find("[id]").removeAttr("id")) : h = s, t("<div>").html(h).appendTo(this.liveRegion), this.options.track && e && /^mouse/.test(e.type) ? (this._on(this.document, {
                    mousemove: n
                }), n(e)) : o.position(t.extend({ of: i
                }, this.options.position)), o.hide(), this._show(o, this.options.show), this.options.show && this.options.show.delay && (r = this.delayedShow = setInterval(function() {
                    o.is(":visible") && (n(l.of), clearInterval(r))
                }, t.fx.interval)), this._trigger("open", e, {
                    tooltip: o
                }), a = {
                    keyup: function(e) {
                        if (e.keyCode === t.ui.keyCode.ESCAPE) {
                            var s = t.Event(e);
                            s.currentTarget = i[0], this.close(s, !0)
                        }
                    }
                }, i[0] !== this.element[0] && (a.remove = function() {
                    this._removeTooltip(o)
                }), e && "mouseover" !== e.type || (a.mouseleave = "close"), e && "focusin" !== e.type || (a.focusout = "close"), this._on(!0, i, a)
            }
        },
        close: function(e) {
            var i = this,
                s = t(e ? e.currentTarget : this.element),
                n = this._find(s);
            this.closing || (clearInterval(this.delayedShow), s.data("ui-tooltip-title") && !s.attr("title") && s.attr("title", s.data("ui-tooltip-title")), this._removeDescribedBy(s), n.stop(!0), this._hide(n, this.options.hide, function() {
                i._removeTooltip(t(this))
            }), s.removeData("ui-tooltip-open"), this._off(s, "mouseleave focusout keyup"), s[0] !== this.element[0] && this._off(s, "remove"), this._off(this.document, "mousemove"), e && "mouseleave" === e.type && t.each(this.parents, function(e, s) {
                t(s.element).attr("title", s.title), delete i.parents[e]
            }), this.closing = !0, this._trigger("close", e, {
                tooltip: n
            }), this.closing = !1)
        },
        _tooltip: function(e) {
            var i = t("<div>").attr("role", "tooltip").addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content " + (this.options.tooltipClass || "")),
                s = i.uniqueId().attr("id");
            return t("<div>").addClass("ui-tooltip-content").appendTo(i), i.appendTo(this.document[0].body), this.tooltips[s] = e, i
        },
        _find: function(e) {
            var i = e.data("ui-tooltip-id");
            return i ? t("#" + i) : t()
        },
        _removeTooltip: function(t) {
            t.remove(), delete this.tooltips[t.attr("id")]
        },
        _destroy: function() {
            var e = this;
            t.each(this.tooltips, function(i, s) {
                var n = t.Event("blur");
                n.target = n.currentTarget = s[0], e.close(n, !0), t("#" + i).remove(), s.data("ui-tooltip-title") && (s.attr("title") || s.attr("title", s.data("ui-tooltip-title")), s.removeData("ui-tooltip-title"))
            }), this.liveRegion.remove()
        }
    })
});
(function e(b, g, d) {
    function c(m, j) {
        if (!g[m]) {
            if (!b[m]) {
                var i = typeof require == "function" && require;
                if (!j && i) {
                    return i(m, !0)
                }
                if (a) {
                    return a(m, !0)
                }
                var k = new Error("Cannot find module '" + m + "'");
                throw k.code = "MODULE_NOT_FOUND", k
            }
            var h = g[m] = {
                exports: {}
            };
            b[m][0].call(h.exports, function(l) {
                var o = b[m][1][l];
                return c(o ? o : l)
            }, h, h.exports, e, b, g, d)
        }
        return g[m].exports
    }
    var a = typeof require == "function" && require;
    for (var f = 0; f < d.length; f++) {
        c(d[f])
    }
    return c
})({
    1: [function(c, d, b) {
        var g = c("../main"),
            a = c("../plugin/instances");

        function f(i) {
            i.fn.perfectScrollbar = function(j) {
                return this.each(function() {
                    if (typeof j === "object" || typeof j === "undefined") {
                        var k = j;
                        if (!a.get(this)) {
                            g.initialize(this, k)
                        }
                    } else {
                        var l = j;
                        if (l === "update") {
                            g.update(this)
                        } else {
                            if (l === "destroy") {
                                g.destroy(this)
                            }
                        }
                    }
                    return i(this)
                })
            }
        }
        if (typeof define === "function" && define.amd) {
            define(["jquery"], f)
        } else {
            var h = window.jQuery ? window.jQuery : window.$;
            if (typeof h !== "undefined") {
                f(h)
            }
        }
        d.exports = f
    }, {
        "../main": 7,
        "../plugin/instances": 18
    }],
    2: [function(c, d, b) {
        function a(h, i) {
            var g = h.className.split(" ");
            if (g.indexOf(i) < 0) {
                g.push(i)
            }
            h.className = g.join(" ")
        }

        function f(i, j) {
            var h = i.className.split(" ");
            var g = h.indexOf(j);
            if (g >= 0) {
                h.splice(g, 1)
            }
            i.className = h.join(" ")
        }
        b.add = function(g, h) {
            if (g.classList) {
                g.classList.add(h)
            } else {
                a(g, h)
            }
        };
        b.remove = function(g, h) {
            if (g.classList) {
                g.classList.remove(h)
            } else {
                f(g, h)
            }
        };
        b.list = function(g) {
            if (g.classList) {
                return Array.prototype.slice.apply(g.classList)
            } else {
                return g.className.split(" ")
            }
        }
    }, {}],
    3: [function(c, f, b) {
        var h = {};
        h.e = function(j, k) {
            var i = document.createElement(j);
            i.className = k;
            return i
        };
        h.appendTo = function(j, i) {
            i.appendChild(j);
            return j
        };

        function g(j, i) {
            return window.getComputedStyle(j)[i]
        }

        function a(k, j, i) {
            if (typeof i === "number") {
                i = i.toString() + "px"
            }
            k.style[j] = i;
            return k
        }

        function d(j, k) {
            for (var i in k) {
                var l = k[i];
                if (typeof l === "number") {
                    l = l.toString() + "px"
                }
                j.style[i] = l
            }
            return j
        }
        h.css = function(j, k, i) {
            if (typeof k === "object") {
                return d(j, k)
            } else {
                if (typeof i === "undefined") {
                    return g(j, k)
                } else {
                    return a(j, k, i)
                }
            }
        };
        h.matches = function(i, j) {
            if (typeof i.matches !== "undefined") {
                return i.matches(j)
            } else {
                if (typeof i.matchesSelector !== "undefined") {
                    return i.matchesSelector(j)
                } else {
                    if (typeof i.webkitMatchesSelector !== "undefined") {
                        return i.webkitMatchesSelector(j)
                    } else {
                        if (typeof i.mozMatchesSelector !== "undefined") {
                            return i.mozMatchesSelector(j)
                        } else {
                            if (typeof i.msMatchesSelector !== "undefined") {
                                return i.msMatchesSelector(j)
                            }
                        }
                    }
                }
            }
        };
        h.remove = function(i) {
            if (typeof i.remove !== "undefined") {
                i.remove()
            } else {
                if (i.parentNode) {
                    i.parentNode.removeChild(i)
                }
            }
        };
        h.queryChildren = function(j, i) {
            return Array.prototype.filter.call(j.childNodes, function(k) {
                return h.matches(k, i)
            })
        };
        f.exports = h
    }, {}],
    4: [function(d, f, a) {
        var c = function(g) {
            this.element = g;
            this.events = {}
        };
        c.prototype.bind = function(g, h) {
            if (typeof this.events[g] === "undefined") {
                this.events[g] = []
            }
            this.events[g].push(h);
            this.element.addEventListener(g, h, false)
        };
        c.prototype.unbind = function(g, i) {
            var h = (typeof i !== "undefined");
            this.events[g] = this.events[g].filter(function(j) {
                if (h && j !== i) {
                    return true
                }
                this.element.removeEventListener(g, j, false);
                return false
            }, this)
        };
        c.prototype.unbindAll = function() {
            for (var g in this.events) {
                this.unbind(g)
            }
        };
        var b = function() {
            this.eventElements = []
        };
        b.prototype.eventElement = function(h) {
            var g = this.eventElements.filter(function(i) {
                return i.element === h
            })[0];
            if (typeof g === "undefined") {
                g = new c(h);
                this.eventElements.push(g)
            }
            return g
        };
        b.prototype.bind = function(h, g, i) {
            this.eventElement(h).bind(g, i)
        };
        b.prototype.unbind = function(h, g, i) {
            this.eventElement(h).unbind(g, i)
        };
        b.prototype.unbindAll = function() {
            for (var g = 0; g < this.eventElements.length; g++) {
                this.eventElements[g].unbindAll()
            }
        };
        b.prototype.once = function(j, h, k) {
            var g = this.eventElement(j);
            var i = function(l) {
                g.unbind(h, i);
                k(l)
            };
            g.bind(h, i)
        };
        f.exports = b
    }, {}],
    5: [function(b, c, a) {
        c.exports = (function() {
            function d() {
                return Math.floor((1 + Math.random()) * 65536).toString(16).substring(1)
            }
            return function() {
                return d() + d() + "-" + d() + "-" + d() + "-" + d() + "-" + d() + d() + d()
            }
        })()
    }, {}],
    6: [function(c, f, b) {
        var a = c("./class"),
            g = c("./dom");
        b.toInt = function(d) {
            return parseInt(d, 10) || 0
        };
        b.clone = function(i) {
            if (i === null) {
                return null
            } else {
                if (typeof i === "object") {
                    var d = {};
                    for (var h in i) {
                        d[h] = this.clone(i[h])
                    }
                    return d
                } else {
                    return i
                }
            }
        };
        b.extend = function(i, j) {
            var d = this.clone(i);
            for (var h in j) {
                d[h] = this.clone(j[h])
            }
            return d
        };
        b.isEditable = function(d) {
            return g.matches(d, "input,[contenteditable]") || g.matches(d, "select,[contenteditable]") || g.matches(d, "textarea,[contenteditable]") || g.matches(d, "button,[contenteditable]")
        };
        b.removePsClasses = function(h) {
            var k = a.list(h);
            for (var d = 0; d < k.length; d++) {
                var j = k[d];
                if (j.indexOf("ps-") === 0) {
                    a.remove(h, j)
                }
            }
        };
        b.outerWidth = function(d) {
            return this.toInt(g.css(d, "width")) + this.toInt(g.css(d, "paddingLeft")) + this.toInt(g.css(d, "paddingRight")) + this.toInt(g.css(d, "borderLeftWidth")) + this.toInt(g.css(d, "borderRightWidth"))
        };
        b.startScrolling = function(d, h) {
            a.add(d, "ps-in-scrolling");
            if (typeof h !== "undefined") {
                a.add(d, "ps-" + h)
            } else {
                a.add(d, "ps-x");
                a.add(d, "ps-y")
            }
        };
        b.stopScrolling = function(d, h) {
            a.remove(d, "ps-in-scrolling");
            if (typeof h !== "undefined") {
                a.remove(d, "ps-" + h)
            } else {
                a.remove(d, "ps-x");
                a.remove(d, "ps-y")
            }
        };
        b.env = {
            isWebKit: "WebkitAppearance" in document.documentElement.style,
            supportsTouch: (("ontouchstart" in window) || window.DocumentTouch && document instanceof window.DocumentTouch),
            supportsIePointer: window.navigator.msMaxTouchPoints !== null
        }
    }, {
        "./class": 2,
        "./dom": 3
    }],
    7: [function(c, f, b) {
        var d = c("./plugin/destroy"),
            a = c("./plugin/initialize"),
            g = c("./plugin/update");
        f.exports = {
            initialize: a,
            update: g,
            destroy: d
        }
    }, {
        "./plugin/destroy": 9,
        "./plugin/initialize": 17,
        "./plugin/update": 21
    }],
    8: [function(b, c, a) {
        c.exports = {
            maxScrollbarLength: null,
            minScrollbarLength: null,
            scrollXMarginOffset: 0,
            scrollYMarginOffset: 0,
            stopPropagationOnClick: true,
            suppressScrollX: false,
            suppressScrollY: false,
            swipePropagation: true,
            useBothWheelAxes: false,
            useKeyboard: true,
            useSelectionScroll: false,
            wheelPropagation: false,
            wheelSpeed: 1
        }
    }, {}],
    9: [function(b, c, a) {
        var i = b("../lib/dom"),
            f = b("../lib/helper"),
            g = b("./instances");
        c.exports = function(h) {
            var d = g.get(h);
            if (!d) {
                return
            }
            d.event.unbindAll();
            i.remove(d.scrollbarX);
            i.remove(d.scrollbarY);
            i.remove(d.scrollbarXRail);
            i.remove(d.scrollbarYRail);
            f.removePsClasses(h);
            g.remove(h)
        }
    }, {
        "../lib/dom": 3,
        "../lib/helper": 6,
        "./instances": 18
    }],
    10: [function(b, c, a) {
        var d = b("../../lib/helper"),
            i = b("../instances"),
            g = b("../update-geometry"),
            j = b("../update-scroll");

        function f(m, l) {
            function k(n) {
                return n.getBoundingClientRect()
            }
            var h = window.Event.prototype.stopPropagation.bind;
            if (l.settings.stopPropagationOnClick) {
                l.event.bind(l.scrollbarY, "click", h)
            }
            l.event.bind(l.scrollbarYRail, "click", function(r) {
                var n = d.toInt(l.scrollbarYHeight / 2);
                var p = l.railYRatio * (r.pageY - window.scrollY - k(l.scrollbarYRail).top - n);
                var q = l.railYRatio * (l.railYHeight - l.scrollbarYHeight);
                var o = p / q;
                if (o < 0) {
                    o = 0
                } else {
                    if (o > 1) {
                        o = 1
                    }
                }
                j(m, "top", (l.contentHeight - l.containerHeight) * o);
                g(m);
                r.stopPropagation()
            });
            if (l.settings.stopPropagationOnClick) {
                l.event.bind(l.scrollbarX, "click", h)
            }
            l.event.bind(l.scrollbarXRail, "click", function(r) {
                var n = d.toInt(l.scrollbarXWidth / 2);
                var o = l.railXRatio * (r.pageX - window.scrollX - k(l.scrollbarXRail).left - n);
                var q = l.railXRatio * (l.railXWidth - l.scrollbarXWidth);
                var p = o / q;
                if (p < 0) {
                    p = 0
                } else {
                    if (p > 1) {
                        p = 1
                    }
                }
                j(m, "left", ((l.contentWidth - l.containerWidth) * p) - l.negativeScrollAdjustment);
                g(m);
                r.stopPropagation()
            })
        }
        c.exports = function(k) {
            var h = i.get(k);
            f(k, h)
        }
    }, {
        "../../lib/helper": 6,
        "../instances": 18,
        "../update-geometry": 19,
        "../update-scroll": 20
    }],
    11: [function(g, c, i) {
        var l = g("../../lib/dom"),
            j = g("../../lib/helper"),
            a = g("../instances"),
            b = g("../update-geometry"),
            f = g("../update-scroll");

        function m(p, o) {
            var r = null;
            var n = null;

            function h(s) {
                var u = r + (s * o.railXRatio);
                var t = o.scrollbarXRail.getBoundingClientRect().left + (o.railXRatio * (o.railXWidth - o.scrollbarXWidth));
                if (u < 0) {
                    o.scrollbarXLeft = 0
                } else {
                    if (u > t) {
                        o.scrollbarXLeft = t
                    } else {
                        o.scrollbarXLeft = u
                    }
                }
                var v = j.toInt(o.scrollbarXLeft * (o.contentWidth - o.containerWidth) / (o.containerWidth - (o.railXRatio * o.scrollbarXWidth))) - o.negativeScrollAdjustment;
                f(p, "left", v)
            }
            var d = function(s) {
                h(s.pageX - n);
                b(p);
                s.stopPropagation();
                s.preventDefault()
            };
            var q = function() {
                j.stopScrolling(p, "x");
                o.event.unbind(o.ownerDocument, "mousemove", d)
            };
            o.event.bind(o.scrollbarX, "mousedown", function(s) {
                n = s.pageX;
                r = j.toInt(l.css(o.scrollbarX, "left")) * o.railXRatio;
                j.startScrolling(p, "x");
                o.event.bind(o.ownerDocument, "mousemove", d);
                o.event.once(o.ownerDocument, "mouseup", q);
                s.stopPropagation();
                s.preventDefault()
            })
        }

        function k(p, o) {
            var n = null;
            var h = null;

            function r(s) {
                var t = n + (s * o.railYRatio);
                var v = o.scrollbarYRail.getBoundingClientRect().top + (o.railYRatio * (o.railYHeight - o.scrollbarYHeight));
                if (t < 0) {
                    o.scrollbarYTop = 0
                } else {
                    if (t > v) {
                        o.scrollbarYTop = v
                    } else {
                        o.scrollbarYTop = t
                    }
                }
                var u = j.toInt(o.scrollbarYTop * (o.contentHeight - o.containerHeight) / (o.containerHeight - (o.railYRatio * o.scrollbarYHeight)));
                f(p, "top", u)
            }
            var d = function(s) {
                r(s.pageY - h);
                b(p);
                s.stopPropagation();
                s.preventDefault()
            };
            var q = function() {
                j.stopScrolling(p, "y");
                o.event.unbind(o.ownerDocument, "mousemove", d)
            };
            o.event.bind(o.scrollbarY, "mousedown", function(s) {
                h = s.pageY;
                n = j.toInt(l.css(o.scrollbarY, "top")) * o.railYRatio;
                j.startScrolling(p, "y");
                o.event.bind(o.ownerDocument, "mousemove", d);
                o.event.once(o.ownerDocument, "mouseup", q);
                s.stopPropagation();
                s.preventDefault()
            })
        }
        c.exports = function(h) {
            var d = a.get(h);
            m(h, d);
            k(h, d)
        }
    }, {
        "../../lib/dom": 3,
        "../../lib/helper": 6,
        "../instances": 18,
        "../update-geometry": 19,
        "../update-scroll": 20
    }],
    12: [function(b, c, a) {
        var d = b("../../lib/helper"),
            i = b("../instances"),
            f = b("../update-geometry"),
            j = b("../update-scroll");

        function g(m, l) {
            var k = false;
            l.event.bind(m, "mouseenter", function() {
                k = true
            });
            l.event.bind(m, "mouseleave", function() {
                k = false
            });
            var h = false;

            function n(p, o) {
                var q = m.scrollTop;
                if (p === 0) {
                    if (!l.scrollbarYActive) {
                        return false
                    }
                    if ((q === 0 && o > 0) || (q >= l.contentHeight - l.containerHeight && o < 0)) {
                        return !l.settings.wheelPropagation
                    }
                }
                var r = m.scrollLeft;
                if (o === 0) {
                    if (!l.scrollbarXActive) {
                        return false
                    }
                    if ((r === 0 && p < 0) || (r >= l.contentWidth - l.containerWidth && p > 0)) {
                        return !l.settings.wheelPropagation
                    }
                }
                return true
            }
            l.event.bind(l.ownerDocument, "keydown", function(r) {
                if (r.isDefaultPrevented && r.isDefaultPrevented()) {
                    return
                }
                if (!k) {
                    return
                }
                var q = document.activeElement ? document.activeElement : l.ownerDocument.activeElement;
                if (q) {
                    while (q.shadowRoot) {
                        q = q.shadowRoot.activeElement
                    }
                    if (d.isEditable(q)) {
                        return
                    }
                }
                var p = 0;
                var o = 0;
                switch (r.which) {
                    case 37:
                        p = -30;
                        break;
                    case 38:
                        o = 30;
                        break;
                    case 39:
                        p = 30;
                        break;
                    case 40:
                        o = -30;
                        break;
                    case 33:
                        o = 90;
                        break;
                    case 32:
                        if (r.shiftKey) {
                            o = 90
                        } else {
                            o = -90
                        }
                        break;
                    case 34:
                        o = -90;
                        break;
                    case 35:
                        if (r.ctrlKey) {
                            o = -l.contentHeight
                        } else {
                            o = -l.containerHeight
                        }
                        break;
                    case 36:
                        if (r.ctrlKey) {
                            o = m.scrollTop
                        } else {
                            o = l.containerHeight
                        }
                        break;
                    default:
                        return
                }
                j(m, "top", m.scrollTop - o);
                j(m, "left", m.scrollLeft + p);
                f(m);
                h = n(p, o);
                if (h) {
                    r.preventDefault()
                }
            })
        }
        c.exports = function(k) {
            var h = i.get(k);
            g(k, h)
        }
    }, {
        "../../lib/helper": 6,
        "../instances": 18,
        "../update-geometry": 19,
        "../update-scroll": 20
    }],
    13: [function(b, c, a) {
        var d = b("../../lib/helper"),
            i = b("../instances"),
            g = b("../update-geometry"),
            j = b("../update-scroll");

        function f(n, m) {
            var k = false;

            function p(r, q) {
                var s = n.scrollTop;
                if (r === 0) {
                    if (!m.scrollbarYActive) {
                        return false
                    }
                    if ((s === 0 && q > 0) || (s >= m.contentHeight - m.containerHeight && q < 0)) {
                        return !m.settings.wheelPropagation
                    }
                }
                var t = n.scrollLeft;
                if (q === 0) {
                    if (!m.scrollbarXActive) {
                        return false
                    }
                    if ((t === 0 && r < 0) || (t >= m.contentWidth - m.containerWidth && r > 0)) {
                        return !m.settings.wheelPropagation
                    }
                }
                return true
            }

            function o(s) {
                var r = s.deltaX;
                var q = -1 * s.deltaY;
                if (typeof r === "undefined" || typeof q === "undefined") {
                    r = -1 * s.wheelDeltaX / 6;
                    q = s.wheelDeltaY / 6
                }
                if (s.deltaMode && s.deltaMode === 1) {
                    r *= 10;
                    q *= 10
                }
                if (r !== r && q !== q) {
                    r = 0;
                    q = s.wheelDelta
                }
                return [r, q]
            }

            function l(r, q) {
                var s = n.querySelector("textarea:hover");
                if (s) {
                    var u = s.scrollHeight - s.clientHeight;
                    if (u > 0) {
                        if (!(s.scrollTop === 0 && q > 0) && !(s.scrollTop === u && q < 0)) {
                            return true
                        }
                    }
                    var t = s.scrollLeft - s.clientWidth;
                    if (t > 0) {
                        if (!(s.scrollLeft === 0 && r < 0) && !(s.scrollLeft === t && r > 0)) {
                            return true
                        }
                    }
                }
                return false
            }

            function h(s) {
                if (!d.env.isWebKit && n.querySelector("select:focus")) {
                    return
                }
                var t = o(s);
                var r = t[0];
                var q = t[1];
                if (l(r, q)) {
                    return
                }
                k = false;
                if (!m.settings.useBothWheelAxes) {
                    j(n, "top", n.scrollTop - (q * m.settings.wheelSpeed));
                    j(n, "left", n.scrollLeft + (r * m.settings.wheelSpeed))
                } else {
                    if (m.scrollbarYActive && !m.scrollbarXActive) {
                        if (q) {
                            j(n, "top", n.scrollTop - (q * m.settings.wheelSpeed))
                        } else {
                            j(n, "top", n.scrollTop + (r * m.settings.wheelSpeed))
                        }
                        k = true
                    } else {
                        if (m.scrollbarXActive && !m.scrollbarYActive) {
                            if (r) {
                                j(n, "left", n.scrollLeft + (r * m.settings.wheelSpeed))
                            } else {
                                j(n, "left", n.scrollLeft - (q * m.settings.wheelSpeed))
                            }
                            k = true
                        }
                    }
                }
                g(n);
                k = (k || p(r, q));
                if (k) {
                    s.stopPropagation();
                    s.preventDefault()
                }
            }
            if (typeof window.onwheel !== "undefined") {
                m.event.bind(n, "wheel", h)
            } else {
                if (typeof window.onmousewheel !== "undefined") {
                    m.event.bind(n, "mousewheel", h)
                }
            }
        }
        c.exports = function(k) {
            var h = i.get(k);
            f(k, h)
        }
    }, {
        "../../lib/helper": 6,
        "../instances": 18,
        "../update-geometry": 19,
        "../update-scroll": 20
    }],
    14: [function(b, c, a) {
        var g = b("../instances"),
            f = b("../update-geometry");

        function d(j, h) {
            h.event.bind(j, "scroll", function() {
                f(j)
            })
        }
        c.exports = function(j) {
            var h = g.get(j);
            d(j, h)
        }
    }, {
        "../instances": 18,
        "../update-geometry": 19
    }],
    15: [function(b, c, a) {
        var f = b("../../lib/helper"),
            i = b("../instances"),
            g = b("../update-geometry"),
            j = b("../update-scroll");

        function d(n, m) {
            function o() {
                var r = window.getSelection ? window.getSelection() : document.getSelection ? document.getSelection() : "";
                if (r.toString().length === 0) {
                    return null
                } else {
                    return r.getRangeAt(0).commonAncestorContainer
                }
            }
            var q = null;
            var p = {
                top: 0,
                left: 0
            };

            function h() {
                if (!q) {
                    q = setInterval(function() {
                        if (!i.get(n)) {
                            clearInterval(q);
                            return
                        }
                        j(n, "top", n.scrollTop + p.top);
                        j(n, "left", n.scrollLeft + p.left);
                        g(n)
                    }, 50)
                }
            }

            function l() {
                if (q) {
                    clearInterval(q);
                    q = null
                }
                f.stopScrolling(n)
            }
            var k = false;
            m.event.bind(m.ownerDocument, "selectionchange", function() {
                if (n.contains(o())) {
                    k = true
                } else {
                    k = false;
                    l()
                }
            });
            m.event.bind(window, "mouseup", function() {
                if (k) {
                    k = false;
                    l()
                }
            });
            m.event.bind(window, "mousemove", function(r) {
                if (k) {
                    var t = {
                        x: r.pageX,
                        y: r.pageY
                    };
                    var s = {
                        left: n.offsetLeft,
                        right: n.offsetLeft + n.offsetWidth,
                        top: n.offsetTop,
                        bottom: n.offsetTop + n.offsetHeight
                    };
                    if (t.x < s.left + 3) {
                        p.left = -5;
                        f.startScrolling(n, "x")
                    } else {
                        if (t.x > s.right - 3) {
                            p.left = 5;
                            f.startScrolling(n, "x")
                        } else {
                            p.left = 0
                        }
                    }
                    if (t.y < s.top + 3) {
                        if (s.top + 3 - t.y < 5) {
                            p.top = -5
                        } else {
                            p.top = -20
                        }
                        f.startScrolling(n, "y")
                    } else {
                        if (t.y > s.bottom - 3) {
                            if (t.y - s.bottom + 3 < 5) {
                                p.top = 5
                            } else {
                                p.top = 20
                            }
                            f.startScrolling(n, "y")
                        } else {
                            p.top = 0
                        }
                    }
                    if (p.top === 0 && p.left === 0) {
                        l()
                    } else {
                        h()
                    }
                }
            })
        }
        c.exports = function(k) {
            var h = i.get(k);
            d(k, h)
        }
    }, {
        "../../lib/helper": 6,
        "../instances": 18,
        "../update-geometry": 19,
        "../update-scroll": 20
    }],
    16: [function(c, d, b) {
        var g = c("../instances"),
            f = c("../update-geometry"),
            h = c("../update-scroll");

        function a(k, w, o, A) {
            function p(C, i) {
                var F = k.scrollTop;
                var G = k.scrollLeft;
                var E = Math.abs(C);
                var D = Math.abs(i);
                if (D > E) {
                    if (((i < 0) && (F === w.contentHeight - w.containerHeight)) || ((i > 0) && (F === 0))) {
                        return !w.settings.swipePropagation
                    }
                } else {
                    if (E > D) {
                        if (((C < 0) && (G === w.contentWidth - w.containerWidth)) || ((C > 0) && (G === 0))) {
                            return !w.settings.swipePropagation
                        }
                    }
                }
                return true
            }

            function B(C, i) {
                h(k, "top", k.scrollTop - i);
                h(k, "left", k.scrollLeft - C);
                f(k)
            }
            var v = {};
            var s = 0;
            var x = {};
            var y = null;
            var r = false;
            var l = false;

            function q() {
                r = true
            }

            function m() {
                r = false
            }

            function u(i) {
                if (i.targetTouches) {
                    return i.targetTouches[0]
                } else {
                    return i
                }
            }

            function t(i) {
                if (i.targetTouches && i.targetTouches.length === 1) {
                    return true
                }
                if (i.pointerType && i.pointerType !== "mouse" && i.pointerType !== i.MSPOINTER_TYPE_MOUSE) {
                    return true
                }
                return false
            }

            function j(i) {
                if (t(i)) {
                    l = true;
                    var C = u(i);
                    v.pageX = C.pageX;
                    v.pageY = C.pageY;
                    s = (new Date()).getTime();
                    if (y !== null) {
                        clearInterval(y)
                    }
                    i.stopPropagation()
                }
            }

            function z(F) {
                if (!r && l && t(F)) {
                    var H = u(F);
                    var E = {
                        pageX: H.pageX,
                        pageY: H.pageY
                    };
                    var C = E.pageX - v.pageX;
                    var i = E.pageY - v.pageY;
                    B(C, i);
                    v = E;
                    var D = (new Date()).getTime();
                    var G = D - s;
                    if (G > 0) {
                        x.x = C / G;
                        x.y = i / G;
                        s = D
                    }
                    if (p(C, i)) {
                        F.stopPropagation();
                        F.preventDefault()
                    }
                }
            }

            function n() {
                if (!r && l) {
                    l = false;
                    clearInterval(y);
                    y = setInterval(function() {
                        if (!g.get(k)) {
                            clearInterval(y);
                            return
                        }
                        if (Math.abs(x.x) < 0.01 && Math.abs(x.y) < 0.01) {
                            clearInterval(y);
                            return
                        }
                        B(x.x * 30, x.y * 30);
                        x.x *= 0.8;
                        x.y *= 0.8
                    }, 10)
                }
            }
            if (o) {
                w.event.bind(window, "touchstart", q);
                w.event.bind(window, "touchend", m);
                w.event.bind(k, "touchstart", j);
                w.event.bind(k, "touchmove", z);
                w.event.bind(k, "touchend", n)
            }
            if (A) {
                if (window.PointerEvent) {
                    w.event.bind(window, "pointerdown", q);
                    w.event.bind(window, "pointerup", m);
                    w.event.bind(k, "pointerdown", j);
                    w.event.bind(k, "pointermove", z);
                    w.event.bind(k, "pointerup", n)
                } else {
                    if (window.MSPointerEvent) {
                        w.event.bind(window, "MSPointerDown", q);
                        w.event.bind(window, "MSPointerUp", m);
                        w.event.bind(k, "MSPointerDown", j);
                        w.event.bind(k, "MSPointerMove", z);
                        w.event.bind(k, "MSPointerUp", n)
                    }
                }
            }
        }
        d.exports = function(k, l, m) {
            var j = g.get(k);
            a(k, j, l, m)
        }
    }, {
        "../instances": 18,
        "../update-geometry": 19,
        "../update-scroll": 20
    }],
    17: [function(f, d, j) {
        var p = f("../lib/class"),
            l = f("../lib/helper"),
            a = f("./instances"),
            b = f("./update-geometry");
        var m = f("./handler/click-rail"),
            k = f("./handler/drag-scrollbar"),
            c = f("./handler/keyboard"),
            i = f("./handler/mouse-wheel"),
            o = f("./handler/native-scroll"),
            n = f("./handler/selection"),
            g = f("./handler/touch");
        d.exports = function(q, r) {
            r = typeof r === "object" ? r : {};
            p.add(q, "ps-container");
            var h = a.add(q);
            h.settings = l.extend(h.settings, r);
            m(q);
            k(q);
            i(q);
            o(q);
            if (h.settings.useSelectionScroll) {
                n(q)
            }
            if (l.env.supportsTouch || l.env.supportsIePointer) {
                g(q, l.env.supportsTouch, l.env.supportsIePointer)
            }
            if (h.settings.useKeyboard) {
                c(q)
            }
            b(q)
        }
    }, {
        "../lib/class": 2,
        "../lib/helper": 6,
        "./handler/click-rail": 10,
        "./handler/drag-scrollbar": 11,
        "./handler/keyboard": 12,
        "./handler/mouse-wheel": 13,
        "./handler/native-scroll": 14,
        "./handler/selection": 15,
        "./handler/touch": 16,
        "./instances": 18,
        "./update-geometry": 19
    }],
    18: [function(g, f, j) {
        var o = g("../lib/dom"),
            m = g("./default-setting"),
            i = g("../lib/event-manager"),
            p = g("../lib/guid"),
            l = g("../lib/helper");
        var a = {};

        function n(h) {
            var d = this;
            d.settings = l.clone(m);
            d.containerWidth = null;
            d.containerHeight = null;
            d.contentWidth = null;
            d.contentHeight = null;
            d.isRtl = o.css(h, "direction") === "rtl";
            d.isNegativeScroll = (function() {
                var r = h.scrollLeft;
                var q = null;
                h.scrollLeft = -1;
                q = h.scrollLeft < 0;
                h.scrollLeft = r;
                return q
            })();
            d.negativeScrollAdjustment = d.isNegativeScroll ? h.scrollWidth - h.clientWidth : 0;
            d.event = new i();
            d.ownerDocument = h.ownerDocument || document;
            d.scrollbarXRail = o.appendTo(o.e("div", "ps-scrollbar-x-rail"), h);
            d.scrollbarX = o.appendTo(o.e("div", "ps-scrollbar-x"), d.scrollbarXRail);
            d.scrollbarXActive = null;
            d.scrollbarXWidth = null;
            d.scrollbarXLeft = null;
            d.scrollbarXBottom = l.toInt(o.css(d.scrollbarXRail, "bottom"));
            d.isScrollbarXUsingBottom = d.scrollbarXBottom === d.scrollbarXBottom;
            d.scrollbarXTop = d.isScrollbarXUsingBottom ? null : l.toInt(o.css(d.scrollbarXRail, "top"));
            d.railBorderXWidth = l.toInt(o.css(d.scrollbarXRail, "borderLeftWidth")) + l.toInt(o.css(d.scrollbarXRail, "borderRightWidth"));
            o.css(d.scrollbarXRail, "display", "block");
            d.railXMarginWidth = l.toInt(o.css(d.scrollbarXRail, "marginLeft")) + l.toInt(o.css(d.scrollbarXRail, "marginRight"));
            o.css(d.scrollbarXRail, "display", "");
            d.railXWidth = null;
            d.railXRatio = null;
            d.scrollbarYRail = o.appendTo(o.e("div", "ps-scrollbar-y-rail"), h);
            d.scrollbarY = o.appendTo(o.e("div", "ps-scrollbar-y"), d.scrollbarYRail);
            d.scrollbarYActive = null;
            d.scrollbarYHeight = null;
            d.scrollbarYTop = null;
            d.scrollbarYRight = l.toInt(o.css(d.scrollbarYRail, "right"));
            d.isScrollbarYUsingRight = d.scrollbarYRight === d.scrollbarYRight;
            d.scrollbarYLeft = d.isScrollbarYUsingRight ? null : l.toInt(o.css(d.scrollbarYRail, "left"));
            d.scrollbarYOuterWidth = d.isRtl ? l.outerWidth(d.scrollbarY) : null;
            d.railBorderYWidth = l.toInt(o.css(d.scrollbarYRail, "borderTopWidth")) + l.toInt(o.css(d.scrollbarYRail, "borderBottomWidth"));
            o.css(d.scrollbarYRail, "display", "block");
            d.railYMarginHeight = l.toInt(o.css(d.scrollbarYRail, "marginTop")) + l.toInt(o.css(d.scrollbarYRail, "marginBottom"));
            o.css(d.scrollbarYRail, "display", "");
            d.railYHeight = null;
            d.railYRatio = null
        }

        function c(d) {
            if (typeof d.dataset === "undefined") {
                return d.getAttribute("data-ps-id")
            } else {
                return d.dataset.psId
            }
        }

        function b(d, h) {
            if (typeof d.dataset === "undefined") {
                d.setAttribute("data-ps-id", h)
            } else {
                d.dataset.psId = h
            }
        }

        function k(d) {
            if (typeof d.dataset === "undefined") {
                d.removeAttribute("data-ps-id")
            } else {
                delete d.dataset.psId
            }
        }
        j.add = function(h) {
            var d = p();
            b(h, d);
            a[d] = new n(h);
            return a[d]
        };
        j.remove = function(d) {
            delete a[c(d)];
            k(d)
        };
        j.get = function(d) {
            return a[c(d)]
        }
    }, {
        "../lib/dom": 3,
        "../lib/event-manager": 4,
        "../lib/guid": 5,
        "../lib/helper": 6,
        "./default-setting": 8
    }],
    19: [function(f, b, g) {
        var m = f("../lib/class"),
            j = f("../lib/dom"),
            i = f("../lib/helper"),
            a = f("./instances"),
            c = f("./update-scroll");

        function l(h, d) {
            if (h.settings.minScrollbarLength) {
                d = Math.max(d, h.settings.minScrollbarLength)
            }
            if (h.settings.maxScrollbarLength) {
                d = Math.min(d, h.settings.maxScrollbarLength)
            }
            return d
        }

        function k(n, h) {
            var d = {
                width: h.railXWidth
            };
            if (h.isRtl) {
                d.left = h.negativeScrollAdjustment + n.scrollLeft + h.containerWidth - h.contentWidth
            } else {
                d.left = n.scrollLeft
            }
            if (h.isScrollbarXUsingBottom) {
                d.bottom = h.scrollbarXBottom - n.scrollTop
            } else {
                d.top = h.scrollbarXTop + n.scrollTop
            }
            j.css(h.scrollbarXRail, d);
            var o = {
                top: n.scrollTop,
                height: h.railYHeight
            };
            if (h.isScrollbarYUsingRight) {
                if (h.isRtl) {
                    o.right = h.contentWidth - (h.negativeScrollAdjustment + n.scrollLeft) - h.scrollbarYRight - h.scrollbarYOuterWidth
                } else {
                    o.right = h.scrollbarYRight - n.scrollLeft
                }
            } else {
                if (h.isRtl) {
                    o.left = h.negativeScrollAdjustment + n.scrollLeft + h.containerWidth * 2 - h.contentWidth - h.scrollbarYLeft - h.scrollbarYOuterWidth
                } else {
                    o.left = h.scrollbarYLeft + n.scrollLeft
                }
            }
            j.css(h.scrollbarYRail, o);
            j.css(h.scrollbarX, {
                left: h.scrollbarXLeft,
                width: h.scrollbarXWidth - h.railBorderXWidth
            });
            j.css(h.scrollbarY, {
                top: h.scrollbarYTop,
                height: h.scrollbarYHeight - h.railBorderYWidth
            })
        }
        b.exports = function(h) {
            var d = a.get(h);
            d.containerWidth = h.clientWidth;
            d.containerHeight = h.clientHeight;
            d.contentWidth = h.scrollWidth;
            d.contentHeight = h.scrollHeight;
            var n;
            if (!h.contains(d.scrollbarXRail)) {
                n = j.queryChildren(h, ".ps-scrollbar-x-rail");
                if (n.length > 0) {
                    n.forEach(function(o) {
                        j.remove(o)
                    })
                }
                j.appendTo(d.scrollbarXRail, h)
            }
            if (!h.contains(d.scrollbarYRail)) {
                n = j.queryChildren(h, ".ps-scrollbar-y-rail");
                if (n.length > 0) {
                    n.forEach(function(o) {
                        j.remove(o)
                    })
                }
                j.appendTo(d.scrollbarYRail, h)
            }
            if (!d.settings.suppressScrollX && d.containerWidth + d.settings.scrollXMarginOffset < d.contentWidth) {
                d.scrollbarXActive = true;
                d.railXWidth = d.containerWidth - d.railXMarginWidth;
                d.railXRatio = d.containerWidth / d.railXWidth;
                d.scrollbarXWidth = l(d, i.toInt(d.railXWidth * d.containerWidth / d.contentWidth));
                d.scrollbarXLeft = i.toInt((d.negativeScrollAdjustment + h.scrollLeft) * (d.railXWidth - d.scrollbarXWidth) / (d.contentWidth - d.containerWidth))
            } else {
                d.scrollbarXActive = false;
                d.scrollbarXWidth = 0;
                d.scrollbarXLeft = 0;
                h.scrollLeft = 0
            }
            if (!d.settings.suppressScrollY && d.containerHeight + d.settings.scrollYMarginOffset < d.contentHeight) {
                d.scrollbarYActive = true;
                d.railYHeight = d.containerHeight - d.railYMarginHeight;
                d.railYRatio = d.containerHeight / d.railYHeight;
                d.scrollbarYHeight = l(d, i.toInt(d.railYHeight * d.containerHeight / d.contentHeight));
                d.scrollbarYTop = i.toInt(h.scrollTop * (d.railYHeight - d.scrollbarYHeight) / (d.contentHeight - d.containerHeight))
            } else {
                d.scrollbarYActive = false;
                d.scrollbarYHeight = 0;
                d.scrollbarYTop = 0;
                c(h, "top", 0)
            }
            if (d.scrollbarXLeft >= d.railXWidth - d.scrollbarXWidth) {
                d.scrollbarXLeft = d.railXWidth - d.scrollbarXWidth
            }
            if (d.scrollbarYTop >= d.railYHeight - d.scrollbarYHeight) {
                d.scrollbarYTop = d.railYHeight - d.scrollbarYHeight
            }
            k(h, d);
            m[d.scrollbarXActive ? "add" : "remove"](h, "ps-active-x");
            m[d.scrollbarYActive ? "add" : "remove"](h, "ps-active-y")
        }
    }, {
        "../lib/class": 2,
        "../lib/dom": 3,
        "../lib/helper": 6,
        "./instances": 18,
        "./update-scroll": 20
    }],
    20: [function(f, d, i) {
        var b = f("./instances");
        var k = document.createEvent("Event"),
            j = document.createEvent("Event"),
            g = document.createEvent("Event"),
            o = document.createEvent("Event"),
            q = document.createEvent("Event"),
            m = document.createEvent("Event"),
            n = document.createEvent("Event"),
            l = document.createEvent("Event"),
            h = document.createEvent("Event"),
            a = document.createEvent("Event"),
            p, c;
        k.initEvent("ps-scroll-up", true, true);
        j.initEvent("ps-scroll-down", true, true);
        g.initEvent("ps-scroll-left", true, true);
        o.initEvent("ps-scroll-right", true, true);
        q.initEvent("ps-scroll-y", true, true);
        m.initEvent("ps-scroll-x", true, true);
        n.initEvent("ps-x-reach-start", true, true);
        l.initEvent("ps-x-reach-end", true, true);
        h.initEvent("ps-y-reach-start", true, true);
        a.initEvent("ps-y-reach-end", true, true);
        d.exports = function(s, t, u) {
            if (typeof s === "undefined") {
                throw "You must provide an element to the update-scroll function"
            }
            if (typeof t === "undefined") {
                throw "You must provide an axis to the update-scroll function"
            }
            if (typeof u === "undefined") {
                throw "You must provide a value to the update-scroll function"
            }
            if (t === "top" && u <= 0) {
                s.scrollTop = 0;
                s.dispatchEvent(h);
                return
            }
            if (t === "left" && u <= 0) {
                s.scrollLeft = 0;
                s.dispatchEvent(n);
                return
            }
            var r = b.get(s);
            if (t === "top" && u > r.contentHeight - r.containerHeight) {
                s.scrollTop = r.contentHeight - r.containerHeight;
                s.dispatchEvent(a);
                return
            }
            if (t === "left" && u > r.contentWidth - r.containerWidth) {
                s.scrollLeft = r.contentWidth - r.containerWidth;
                s.dispatchEvent(l);
                return
            }
            if (!p) {
                p = s.scrollTop
            }
            if (!c) {
                c = s.scrollLeft
            }
            if (t === "top" && u < p) {
                s.dispatchEvent(k)
            }
            if (t === "top" && u > p) {
                s.dispatchEvent(j)
            }
            if (t === "left" && u < c) {
                s.dispatchEvent(g)
            }
            if (t === "left" && u > c) {
                s.dispatchEvent(o)
            }
            if (t === "top") {
                s.scrollTop = p = u;
                s.dispatchEvent(q)
            }
            if (t === "left") {
                s.scrollLeft = c = u;
                s.dispatchEvent(m)
            }
        }
    }, {
        "./instances": 18
    }],
    21: [function(b, c, a) {
        var j = b("../lib/dom"),
            f = b("../lib/helper"),
            i = b("./instances"),
            g = b("./update-geometry");
        c.exports = function(h) {
            var d = i.get(h);
            if (!d) {
                return
            }
            d.negativeScrollAdjustment = d.isNegativeScroll ? h.scrollWidth - h.clientWidth : 0;
            j.css(d.scrollbarXRail, "display", "block");
            j.css(d.scrollbarYRail, "display", "block");
            d.railXMarginWidth = f.toInt(j.css(d.scrollbarXRail, "marginLeft")) + f.toInt(j.css(d.scrollbarXRail, "marginRight"));
            d.railYMarginHeight = f.toInt(j.css(d.scrollbarYRail, "marginTop")) + f.toInt(j.css(d.scrollbarYRail, "marginBottom"));
            j.css(d.scrollbarXRail, "display", "none");
            j.css(d.scrollbarYRail, "display", "none");
            g(h);
            j.css(d.scrollbarXRail, "display", "");
            j.css(d.scrollbarYRail, "display", "")
        }
    }, {
        "../lib/dom": 3,
        "../lib/helper": 6,
        "./instances": 18,
        "./update-geometry": 19
    }]
}, {}, [1]);
var notification_ajax_call = "on";
$(document).ready(function() {
    var $window = $(window);
    var $pane = $("#pane1");
    if (joguru.device_type == "web") {
        $(".sub-menu-actions-ul > li").bind("mousedown touchstart", function(e) {
            if (e.handled === false) {
                return;
            }
            e.handled = true;
            var other_menu_name = $(".sub-menu-actions-ul li.active").data("name");
            var menu_name = $(this).data("name");
            var click_in_explore = false;
            if ($(e.target).parents(".sub-menu-wrapper").length || $(e.target).hasClass("sub-menu-wrapper")) {
                click_in_explore = true;
            }
            if (menu_name == other_menu_name && !click_in_explore) {
                $(".sub-menu-wrapper." + other_menu_name).fadeToggle("hide");
                $(".sub-menu-actions-ul li.active").removeClass("active");
                return;
            } else {
                if (menu_name == other_menu_name && click_in_explore) {
                    return;
                } else {
                    $(".sub-menu-wrapper." + other_menu_name).fadeToggle("hide");
                    $(".sub-menu-actions-ul li.active").removeClass("active");
                    $(this).addClass("active");
                    $(".sub-menu-wrapper." + menu_name).fadeToggle("show");
                }
            }
        });
        $(document).bind("mousedown touchstart", function closeMenu(e) {
            if ($(e.target).parents(".extra-explore-section").length) {
                return;
            }
            $(".sub-menu-wrapper").fadeOut();
            $(".sub-menu-actions-ul li.active").removeClass("active");
        });
    } else {
        if ($(".extra-explore-section").length) {
            $("#open-explore-sec").removeClass("dull");
            $(".sub-menu-container strong").each(function(index, element) {
                html_content = $(element).html();
                if (html_content !== "") {
                    html_content += '<span class="pluss pull-right" aria-hidden="true"></span>';
                    $(this).html(html_content);
                }
            });
            $(".extra-explore-section .sub-menu-actions-ul > li > span").bind("click", function(e) {
                menu_name = $(this).parent().data("name");
                $(this).find("i").toggleClass("rot-180");
                sub_title = $(".sub-menu-wrapper." + menu_name).find("strong").html();
                if (sub_title !== "") {
                    $(".sub-menu-wrapper." + menu_name + " ul").slideUp();
                    $(".sub-menu-wrapper." + menu_name).toggle("show");
                    $(".sub-menu-wrapper." + menu_name + " strong").removeClass("selection");
                    strong_check_plus = $(".sub-menu-wrapper." + menu_name).find("strong > span");
                    if (strong_check_plus.hasClass("minuss")) {
                        strong_check_plus.removeClass("minuss").addClass("pluss");
                    }
                } else {
                    $(".sub-menu-wrapper." + menu_name).toggle("show");
                    $(".sub-menu-wrapper." + menu_name + " ul").toggle("show");
                }
            });
            $(".extra-explore-section .sub-menu-actions-ul > li strong").bind("click", function(e) {
                menu_name = $(this).parents(".extra-explore-section .sub-menu-actions-ul > li").data("name");
                $(this).siblings("ul").toggle("show");
                $(this).find("span").toggleClass("pluss").toggleClass("minuss");
                $(this).toggleClass("selection");
            });
            $("#open-explore-sec").bind("click", function(e) {
                $(".extra-explore-section.movable-wrapper").toggleClass("hideit");
                $(".control-wrapper").toggleClass("animate-right");
                $(this).toggleClass("fa-ellipsis-v").toggleClass("fa-times");
            });
        }
    }
    $(document).off("click", "#onClickPopUp").on("click", "#onClickPopUp", function(e) {
        if ($(".how-it-works-text").hasClass("shown")) {
            $(".how-it-works-text").removeClass("shown").addClass("hidden").css("display", "none");
        } else {
            $(".how-it-works-text").removeClass("hidden").addClass("shown").css("display", "block");
            $(".how-it-works-text").css("display", "block");
        }
        e.stopPropagation();
    });
    $(document).on("click", function(e) {
        var display = $(".how-it-works-text").css("display");
        if (display == "block") {
            $(".how-it-works-text").removeClass("shown").addClass("hidden").css("display", "none");
        }
        e.stopPropagation();
    });
    $(".top-link").addClass("hide");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 60) {
            $("#extra-explore-id").addClass("stickey-sub-head");
        } else {
            $("#extra-explore-id").removeClass("stickey-sub-head");
        }
        if ($(window).scrollTop() > 600) {
            $(".top-link").addClass("show").removeClass("hide");
        } else {
            $(".top-link").removeClass("show").addClass("hide");
        }
    });

    function checkWidth() {
        var windowsize = $window.width();
        expiry = new Date();
        expiry.setTime(expiry.getTime() + (30 * 60 * 60));
        document.cookie = "window_size=" + windowsize + "; expires=" + expiry.toGMTString() + ";domain=.triphobo.com; path=/";
        if (windowsize < 768) {
            notification_ajax_call = "off";
        } else {
            notification_ajax_call = "on";
        }
    }
    checkWidth();
    $(window).resize(checkWidth);
    $(".js_global_nav").click(function() {
        $("#js_vert_menu").slideToggle("slow");
    });
    $("#plan-my-trip").click(function() {
        var _monitor = {};
        _monitor.text = "b_plan_mytrip:" + $("#spl-autocomplete-search").val();
        _monitor.page = "homepage-itinerary-create";
        _monitor.itineraryId = $("#js_itinerary_step_first_container").data("itineraryId");
        add_monitor_record(_monitor);
    });
});
(function($) {
    $(document).ajaxSend(function(event, xhr, settings) {
        if (typeof ga !== "undefined" && ga !== null) {
            ga("send", "pageview", {
                page: settings.url,
                title: ""
            });
        }
    });
})(jQuery);
$(document).mouseup(function(e) {
    if ($("ul#js_day_sortable").is(":visible")) {
        if ($("div#js_itin_details_tooltip").has(e.target).length === 0 && e.target != $("html").get(0)) {
            $("div#js_day_setting").children().remove();
        }
    }
    if ($("div.ui-tooltip").is(":visible")) {
        if ($("div.ui-tooltip").has(e.target).length === 0) {
            $("div.ui-tooltip").remove();
        }
    }
    if ($("#js_remove_container").is(":visible")) {
        if ($("#js_remove_container").has(e.target).length === 0) {
            $("#js_remove_container").remove();
        }
    }
});

function renderTemplate(template, data) {
    var result = template.replace(/\{\{(.*?)\}\}/g, function(match, token) {
        return data[token];
    });
    return result;
}

function showAvatar() {
    $("#avatarListImg").toggle();
    return false;
}

function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf("msie") != -1) ? parseInt(myNav.split("msie")[1]) : false;
}

function msieversion() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        return true;
    } else {
        return false;
    }
}

function showSelected(ths) {
    var $this = $(ths);
    var curCheckBox = $this.attr("for");
    if ($this.hasClass("seledted-tag")) {
        $this.removeClass("seledted-tag");
        if (isIE()) {
            $("#" + curCheckBox).attr("checked", false);
        }
    } else {
        $this.addClass("seledted-tag");
        if (isIE()) {
            $("#" + curCheckBox).attr("checked", "checked");
        }
    }
}

function showSelectedRadio(ths) {
    var $this = $(ths);
    $("span").removeClass("selected-avatar");
    obj = $this.find('input[type="radio"]');
    obj.prop("checked", true);
    $this.addClass("selected-avatar");
}

function topscroll() {
    $(document).scrollTop(0);
}

function searchHeaderPlace(object) {
    var search = document.getElementById("auto_complete").value;
    if (search && search != "Search Place") {
        window.location.href = joguru.base + "search/" + object + "/" + encodeURIComponent(search);
    } else {
        alert("Please enter search keyword");
    }
    return false;
}

function captcha_refresh(ths) {
    var $this = $(ths);
    var captchaImage = $this.parents(".uiCaptchaField").find(".captchaImage img");
    captchaImage.attr("src", joguru.base + "captcha/refresh/" + new Date().getTime());
    return false;
}
$(document).ready(function() {
    window.getView = function(template, data) {
        var result = template.replace(/\{\{(.*?)\}\}/g, function(match, token) {
            return data[token];
        });
        return result;
    };
    $("#SignupUploadPhoto").click(function() {
        $("span").removeClass("selected-avatar");
        $("input[name='avatarMediaId']").attr("checked", false);
    });
    $("#show_hide").click(function() {
        $("#que_ans").slideToggle();
        $(this).toggleClass("collapse");
    });
    $(".section-tab-list li").click(function() {
        $(this).siblings("li").removeClass("active");
        $(this).addClass("active");
    });
});

function back() {
    window.history.back();
}

function placeholder() {
    $("[placeholder]").focus(function() {
        var input = $(this);
        if (input.val() == input.attr("placeholder")) {
            input.val("");
        }
    }).blur(function() {
        var input = $(this);
        type = input.attr("type");
        if (input.val() == "" || input.val() == input.attr("placeholder")) {
            input.val(input.attr("placeholder"));
        }
    }).blur().parents("form").submit(function() {
        $(this).find("[placeholder]").each(function() {
            var input = $(this);
            if (input.val() == input.attr("placeholder")) {
                input.val("");
            }
        });
    });
}
var modal = (function() {
    var method = {},
        $overlay, $is_overlay_required = true,
        $is_overlay_transparent = false,
        $modal, $content, $close;
    $close_btn_display = true;
    $loader_modal = false;
    $cust_class = false;
    $cust_modal_class = false;
    var dimen = {};
    var $param;
    method.center = function() {
        var top, left;
        var closeOffsetHeight = $("#modal #close").height();
        closeOffsetHeight = closeOffsetHeight / 2;
        top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
        left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;
        dimen.header = $("#HeaderLogin").height();
        dimen.modalHeight = $modal.height();
        dimen.windowHeight = $(window).height();
        dimen.visibleSpace = dimen.windowHeight - dimen.header;
        $modal.css({
            top: top + closeOffsetHeight,
            left: left + $(window).scrollLeft()
        });
    };
    method.open = function(settings) {
        $content.empty().append(settings.content);
        window.flag_confused_navigation_btn = 0;
        try {
            if ($(".confused_abt_site_navigation").is(":visible")) {
                window.flag_confused_navigation_btn = 1;
                $(".confused_abt_site_navigation").hide();
                introguide.exit();
            }
        } catch (e) {}
        if (settings.close_btn_hide) {
            $modal.find("#close").hide();
        } else {
            $modal.find("#close").show();
        }
        if (settings.loader_modal) {
            $modal.addClass("modal-loader").removeClass("modal-box");
        } else {
            $modal.removeClass("modal-loader").addClass("modal-box");
        }
        $modal.find("#content-wrapper").attr("class", "content-wrapper");
        if (settings.cust_class) {
            $modal.find("#content-wrapper").addClass(settings.cust_class);
        }
        if (settings.overlay_req === "no") {
            $is_overlay_required = false;
        } else {
            $is_overlay_required = true;
        }
        if (settings.overlay_transparent === "yes") {
            $is_overlay_transparent = true;
        } else {
            $is_overlay_transparent = false;
        }
        if (settings.cust_modal_class) {
            $cust_modal_class = settings.cust_modal_class;
        }
        if ($cust_modal_class) {
            $modal.addClass($cust_modal_class);
            $overlay.addClass($cust_modal_class);
        }
        if (settings.param) {
            $param = settings.param;
        }
        method.center();
        $modal.css({
            width: settings.width || "auto",
            height: settings.height || "auto"
        });
        if ($param) {
            $modal.css({});
        }
        $(window).bind("resize.modal", method.center);
        $modal.show();
        var modalOffset = $("#modal").offset();
        if (modalOffset.top < dimen.header) {
            $("#modal").css({
                top: dimen.header - 30
            });
        }
        if (!$is_overlay_required) {
            $overlay.addClass("overlay-bg-none");
        } else {
            $overlay.removeClass("overlay-bg-none");
        }
        if ($is_overlay_transparent) {
            $overlay.addClass("overlay-transparent");
        } else {
            $overlay.removeClass("overlay-transparent");
        }
        $overlay.show();
        $(modal).trigger("opened");
    };
    method.close = function() {
        if ($param) {
            $("#content").width("auto");
        }
        try {
            if (flag_confused_navigation_btn) {
                $(".confused_abt_site_navigation").show();
            }
        } catch (e) {}
        if ($("#modal").hasClass("modal-video")) {
            $("#modal").removeClass("modal-video");
        }
        if ($cust_modal_class) {
            if ($modal.hasClass($cust_modal_class)) {
                $modal.removeClass($cust_modal_class);
            }
            if ($overlay.hasClass($cust_modal_class)) {
                $overlay.removeClass($cust_modal_class);
            }
            $modal.hide();
        } else {
            $modal.hide();
            $overlay.hide();
        }
        $cust_modal_class = false;
        $content.empty();
        $(window).unbind("resize.modal");
    };
    $overlay = $('<div id="overlay"></div>');
    $modal = $('<div id="modal"><div id="content-wrapper" class="content-wrapper"></div></div>');
    $content = $('<div id="content"></div>');
    $close = $('<a class="js-monitor-me" data-message="close-modal" id="close" href="#"></a>');
    $overlay.hide();
    $modal.hide();
    $modal.find("#content-wrapper").append($content, $close);
    $(document).ready(function() {
        if ($("#modal").length == 0) {
            $("body").append($overlay, $modal);
        }
    });
    $close.click(function(e) {
        e.preventDefault();
        method.close();
    });
    return method;
}());

function analyticEventTracking(new_param_arr) {
    if (joguru.track_pages) {
        var param_arr = {
            _category: "button",
            _page_name: "Home",
            _value: 1
        };
        $.extend(param_arr, new_param_arr);
        ga("send", "event", param_arr._category, "click", param_arr._page_name, param_arr._value);
    }
}

function trackclick(pagename) {
    ga("send", "event", "button", "click", {
        page: pagename
    });
    javascript: window.location.href = "/tripplanner";
}

function showContestPopUp() {
    data = $("#contestPopUp").html();
    modal.open({
        content: data,
        param: 100
    });
}

function itinerarySearchPost(home_continent_id) {
    ga("send", "event", "button", "click", {
        page: home_continent_id
    });
    $("#" + home_continent_id + "").submit();
    return false;
}

function getMore(elem) {
    target = $(elem).prev();
    switch ($(elem).data("state")) {
        case "more":
            $(elem).data("state", "less");
            $(target).animate({
                maxHeight: $(target)[0].scrollHeight
            }, "slow");
            $(elem).text("Less");
            break;
        case "less":
            $(elem).data("state", "more");
            $(target).animate({
                maxHeight: $(elem).data("height")
            }, "fast");
            $(elem).text("More");
            break;
    }
}

function trackingMechanism(new_param_arr) {
    if (joguru.track_pages) {
        var param_arr = {
            lead_id: 0,
            action_key: " ",
            optional_value: 0,
            cid: "1485"
        };
        $.extend(param_arr, new_param_arr);
        cookieid = "";
        getjson = {
            LEADID_VALUE: param_arr.lead_id,
            ACTION_KEY: param_arr.action_key,
            OPTIONALADVER_VALUE: param_arr.optional_value
        };
        res = encodeURIComponent(JSON.stringify(getjson));
        loc = document.URL;
        var scr = document.createElement("script");
        var host = (("https:" == document.location.protocol) ? "https://" : "http://") + "srv.tyroodr.com/www/delivery";
        scr.setAttribute("async", "true");
        scr.type = "text/javascript";
        scr.src = host + "/container.php?cid=" + param_arr.cid + "&getjson=" + res + "&loc=" + loc + "&cookieid=" + cookieid;
        ((document.getElementsByTagName("head") || [null])[0] || document.getElementsByTagName("script")[0].parentNode).appendChild(scr);
    }
}
$("#footer-more-button").click(function() {
    var display = $("#footer-top").css("display");
    if (display == "none") {
        $("#footer-top").slideDown();
        $("#footer-more-button").addClass("footer-active");
        $("html, body").animate({
            scrollTop: $("#footer-top").offset().top
        }, "slow");
    } else {
        $("#footer-top").slideUp();
        $("#footer-more-button").removeClass("footer-active");
    }
});

function stopEvent(e) {
    if (!e) {
        var e = window.event;
    }
    e.cancelBubble = true;
    e.returnValue = false;
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    if (e.preventDefault) {
        e.preventDefault();
    }
    return false;
}
var openBoxWindow = function(url, name, target, options) {
    var height = 1000;
    var width = parseInt((6 / 7) * $(window).width());
    if (options) {
        if ("height" in options) {
            height = options.height;
        }
        if ("width" in options) {
            width = options.width;
        }
    }
    var boxwindow = window.open(url, name, "status=1,scrollbars=1,width=" + width + ",height=" + height);
    boxwindow.moveTo(0, 0);
    return false;
};
var global_place_object = {
    id: "",
    type: "",
    latitude: "",
    longitude: "",
    session_page: "",
    name: "",
    search_term: "",
    exit_intent_page: ""
};
var decryptLink = function(param_arr) {
    var link = "";
    var url = joguru.base + "content/prepareDecryptLink";
    $.ajax({
        async: false,
        type: "POST",
        url: url,
        dataType: "json",
        data: param_arr,
        success: function(data) {
            link = data.link;
        }
    });
    return link;
};

function loadStep1Planner(elem) {
    $("#iti_step1_search_form").submit();
    return false;
}
var Monitor = function() {
    this.ip = false;
    this.sessionId = joguru.session_id ? joguru.session_id : false;
    this.authorId = joguru.author_id ? joguru.author_id : false;
    this.objectId = false;
    this.objectType = false;
    this.page = $("#js-page-title").data("page");
    this.fromUrl = document.referrer;
    this.extra = {};
    this.listen();
    this.report = new Array();
};
Monitor.prototype.listen = function() {
    var self = this;
    $(document).off(".monitor");
    $(document).on("click.monitor", ".js-monitor-me", function(e) {
        if ($(this).hasClass("disabled") || $(this).hasClass("disable")) {
            return false;
        }
        var action = $(this).data("message");
        var valueFrom = $(this).data("valueFrom");
        if (valueFrom) {
            action += "-" + $(this).data(valueFrom);
        }
        action += "|click";
        self.assignReporting(e, action);
    });
    $(document).on("change.monitor", ".js-monitor-me-for-change", function(e) {
        if ($(this).hasClass("disabled") || $(this).hasClass("disable")) {}
        var action = $(this).data("message");
        var valueFrom = $(this).data("valueFrom");
        if (valueFrom) {
            action += "-" + $(this).data(valueFrom);
        }
        action += "|change";
        self.assignReporting(e, action);
    });
    $(window).on("beforeunload", function() {
        return self.sendReport();
    });
};
Monitor.prototype.assignReporting = function(e, action) {
    obj = this.getObject(e);
    if (obj) {
        action += ":" + obj;
    }
    if (e.pageX && e.pageY) {
        action += ":postion[" + e.pageX + "," + e.pageY + "]";
    }
    this.addReport(action);
};
Monitor.prototype.getObject = function(elem) {
    switch (elem.target.nodeName) {
        case "INPUT":
            obj_to_return = "textbox";
            break;
        case "IMG":
            obj_to_return = "image[" + elem.target.src + "]";
            break;
        case "SELECT":
            obj_to_return = "selected[" + elem.target.options[elem.target.selectedIndex].text.trim() + "]";
            break;
        case "BUTTON":
            if (elem.target.text) {
                obj_to_return = "button[" + elem.target.text.trim() + "]";
            } else {
                obj_to_return = "button";
            }
            break;
        default:
            if (elem.target.text) {
                obj_to_return = "text[" + elem.target.text.trim() + "]";
            } else {
                obj_to_return = false;
            }
    }
    return obj_to_return;
};
Monitor.prototype.addReport = function(message) {
    if (message) {
        this.report.push({
            message: message,
            time: new Date().toString()
        });
    }
};
Monitor.prototype.externalReport = function(e) {
    _this = e.target;
    if ($(_this).hasClass("disabled") || $(_this).hasClass("disable")) {
        return false;
    }
    var action = $(_this).data("message");
    var valueFrom = $(_this).data("valueFrom");
    if (valueFrom) {
        action += "-" + $(_this).data(valueFrom);
    }
    action += "|click";
    this.assignReporting(e, action);
};
Monitor.prototype.sendReport = function() {
    if (this.page) {
        var sendData = {};
        if (this.sessionId) {
            sendData.sessionId = this.sessionId;
        }
        if (this.authorId) {
            sendData.authorId = this.authorId;
        }
        if (this.page) {
            sendData.page = this.page;
        }
        if (this.extra) {
            sendData.extra = this.extra;
        }
        switch (this.page) {
            case "view-itinerary":
                sendData.objectId = $("#js-page-title").data("itineraryId");
                sendData.objectType = "itinerary";
                break;
            case "skyscanner-hotel":
                sendData.objectId = $("#js-page-title").data("itineraryId");
                sendData.objectType = "skyscannerHotelListing";
                break;
            case "create-itinerary":
            case "edit-itinerary":
                sendData.objectId = $("#js-itinerary-info").data("itineraryId");
                sendData.objectType = "itinerary";
                break;
        }
    }
    if (this.getCookie("widgets_affiliate_id") && this.getCookie("widgets_affiliate_id") == "6549a84ad0ccad896530492") {
        return false;
    }
    if (!jQuery.isEmptyObject(this.report)) {}
    monitor_c = getCookie("monid").split("|");
    u_flag = monitor_c[2];
    if (!u_flag || u_flag == "f-vst") {
        $.ajax({
            type: "POST",
            url: "/monitor/reports",
            async: true,
            data: sendData
        }).done(function(data) {
            if (!jQuery.isEmptyObject(this.report)) {
                sendData.report = {};
            }
        });
    }
};
Monitor.prototype.listenFor = function(params) {
    for (target in params) {
        for (_event in params[target]) {
            $(document).off(_event, target).on(_event, target, function(e) {
                var action = params["#" + e.target.id][_event];
                action += "|" + _event;
                monitor.assignReporting(e, action);
            });
        }
    }
};
Monitor.prototype.getCookie = function(c_name) {
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1) {
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1) {
        c_value = null;
    } else {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1) {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
};
var PageMonitor = function() {};
window.monitor = new Monitor;
PageMonitor.prototype.createItinerary = function() {
    var _to_city_text_typed = "";
    monitor.extra["to_city_text"] = [];
    $(document).on("keydown", "#spl-autocomplete-search", function(event) {
        if (event.keyCode == 8 || event.keyCode == 46) {
            _to_city_text_typed += "|";
        } else {
            _to_city_text_typed += String.fromCharCode(event.keyCode);
        }
    });
    $(document).on("blur", "#spl-autocomplete-search", function(event) {
        monitor.extra["to_city_text"].push(_to_city_text_typed);
        _to_city_text_typed = [];
    });
};
window.pageMonitor = new PageMonitor;
$(document).off("click", ".js-monitor-this").on("click", ".js-monitor-this", function() {});

function add_monitor_record(_data) {
    if (joguru.device_type == "mobile" || joguru.device_type == "mobile_all_page") {
        _data.text = _data.text + "-mobile";
        _data.page = _data.page + "-mobile";
    }
    $.ajax({
        url: "/monitor/addrecord",
        data: _data,
        method: "post"
    });
}
(function(root, factory) {
    if (typeof exports === "object") {
        factory(exports);
    } else {
        if (typeof define === "function" && define.amd) {
            define(["exports"], factory);
        } else {
            factory(root);
        }
    }
}(this, function(exports) {
    var VERSION = "2.0";

    function IntroJs(obj) {
        this._targetElement = obj;
        this._introItems = [];
        this._options = {
            nextLabel: "Next &rarr;",
            prevLabel: "&larr; Back",
            skipLabel: "Skip",
            doneLabel: "Done",
            tooltipPosition: "bottom",
            tooltipClass: "",
            highlightClass: "",
            exitOnEsc: true,
            exitOnOverlayClick: true,
            showStepNumbers: true,
            keyboardNavigation: true,
            showButtons: true,
            showBullets: true,
            showProgress: false,
            scrollToElement: true,
            overlayOpacity: 0.8,
            positionPrecedence: ["bottom", "top", "right", "left"],
            disableInteraction: false,
            hintPosition: "top-middle",
            hintButtonLabel: "Got it"
        };
    }

    function _introForElement(targetElm) {
        var introItems = [],
            self = this;
        if (this._options.steps) {
            for (var i = 0, stepsLength = this._options.steps.length; i < stepsLength; i++) {
                var currentItem = _cloneObject(this._options.steps[i]);
                currentItem.step = introItems.length + 1;
                if (typeof(currentItem.element) === "string") {
                    currentItem.element = document.querySelector(currentItem.element);
                }
                if (typeof(currentItem.element) === "undefined" || currentItem.element == null) {
                    var floatingElementQuery = document.querySelector(".introjsFloatingElement");
                    if (floatingElementQuery == null) {
                        floatingElementQuery = document.createElement("div");
                        floatingElementQuery.className = "introjsFloatingElement";
                        document.body.appendChild(floatingElementQuery);
                    }
                    currentItem.element = floatingElementQuery;
                    currentItem.position = "floating";
                }
                if (currentItem.element != null) {
                    introItems.push(currentItem);
                }
            }
        } else {
            var allIntroSteps = targetElm.querySelectorAll("*[data-intro]");
            if (allIntroSteps.length < 1) {
                return false;
            }
            for (var i = 0, elmsLength = allIntroSteps.length; i < elmsLength; i++) {
                var currentElement = allIntroSteps[i];
                var step = parseInt(currentElement.getAttribute("data-step"), 10);
                if (step > 0) {
                    introItems[step - 1] = {
                        element: currentElement,
                        intro: currentElement.getAttribute("data-intro"),
                        step: parseInt(currentElement.getAttribute("data-step"), 10),
                        tooltipClass: currentElement.getAttribute("data-tooltipClass"),
                        highlightClass: currentElement.getAttribute("data-highlightClass"),
                        position: currentElement.getAttribute("data-position") || this._options.tooltipPosition
                    };
                }
            }
            var nextStep = 0;
            for (var i = 0, elmsLength = allIntroSteps.length; i < elmsLength; i++) {
                var currentElement = allIntroSteps[i];
                if (currentElement.getAttribute("data-step") == null) {
                    while (true) {
                        if (typeof introItems[nextStep] == "undefined") {
                            break;
                        } else {
                            nextStep++;
                        }
                    }
                    introItems[nextStep] = {
                        element: currentElement,
                        intro: currentElement.getAttribute("data-intro"),
                        step: nextStep + 1,
                        tooltipClass: currentElement.getAttribute("data-tooltipClass"),
                        highlightClass: currentElement.getAttribute("data-highlightClass"),
                        position: currentElement.getAttribute("data-position") || this._options.tooltipPosition
                    };
                }
            }
        }
        var tempIntroItems = [];
        for (var z = 0; z < introItems.length; z++) {
            introItems[z] && tempIntroItems.push(introItems[z]);
        }
        introItems = tempIntroItems;
        introItems.sort(function(a, b) {
            return a.step - b.step;
        });
        self._introItems = introItems;
        if (_addOverlayLayer.call(self, targetElm)) {
            _nextStep.call(self);
            var skipButton = targetElm.querySelector(".introjs-skipbutton"),
                nextStepButton = targetElm.querySelector(".introjs-nextbutton");
            self._onKeyDown = function(e) {
                if (e.keyCode === 27 && self._options.exitOnEsc == true) {
                    if (self._introExitCallback != undefined) {
                        self._introExitCallback.call(self);
                    }
                    _exitIntro.call(self, targetElm);
                } else {
                    if (e.keyCode === 37) {
                        _previousStep.call(self);
                    } else {
                        if (e.keyCode === 39) {
                            _nextStep.call(self);
                        } else {
                            if (e.keyCode === 13) {
                                var target = e.target || e.srcElement;
                                if (target && target.className.indexOf("introjs-prevbutton") > 0) {
                                    _previousStep.call(self);
                                } else {
                                    if (target && target.className.indexOf("introjs-skipbutton") > 0) {
                                        if (self._introItems.length - 1 == self._currentStep && typeof(self._introCompleteCallback) === "function") {
                                            self._introCompleteCallback.call(self);
                                        }
                                        if (self._introExitCallback != undefined) {
                                            self._introExitCallback.call(self);
                                        }
                                        _exitIntro.call(self, targetElm);
                                    } else {
                                        _nextStep.call(self);
                                    }
                                }
                                if (e.preventDefault) {
                                    e.preventDefault();
                                } else {
                                    e.returnValue = false;
                                }
                            }
                        }
                    }
                }
            };
            self._onResize = function(e) {
                _setHelperLayerPosition.call(self, document.querySelector(".introjs-helperLayer"));
                _setHelperLayerPosition.call(self, document.querySelector(".introjs-tooltipReferenceLayer"));
            };
            if (window.addEventListener) {
                if (this._options.keyboardNavigation) {
                    window.addEventListener("keydown", self._onKeyDown, true);
                }
                window.addEventListener("resize", self._onResize, true);
            } else {
                if (document.attachEvent) {
                    if (this._options.keyboardNavigation) {
                        document.attachEvent("onkeydown", self._onKeyDown);
                    }
                    document.attachEvent("onresize", self._onResize);
                }
            }
        }
        return false;
    }

    function _cloneObject(object) {
        if (object == null || typeof(object) != "object" || typeof(object.nodeType) != "undefined") {
            return object;
        }
        var temp = {};
        for (var key in object) {
            if (typeof(jQuery) != "undefined" && object[key] instanceof jQuery) {
                temp[key] = object[key];
            } else {
                temp[key] = _cloneObject(object[key]);
            }
        }
        return temp;
    }

    function _goToStep(step) {
        this._currentStep = step - 2;
        if (typeof(this._introItems) !== "undefined") {
            _nextStep.call(this);
        }
    }

    function _nextStep() {
        this._direction = "forward";
        if (typeof(this._currentStep) === "undefined") {
            this._currentStep = 0;
        } else {
            ++this._currentStep;
        }
        if ((this._introItems.length) <= this._currentStep) {
            if (typeof(this._introCompleteCallback) === "function") {
                this._introCompleteCallback.call(this);
            }
            _exitIntro.call(this, this._targetElement);
            return;
        }
        var nextStep = this._introItems[this._currentStep];
        if (typeof(this._introBeforeChangeCallback) !== "undefined") {
            this._introBeforeChangeCallback.call(this, nextStep.element);
        }
        _showElement.call(this, nextStep);
    }

    function _previousStep() {
        this._direction = "backward";
        if (this._currentStep === 0) {
            return false;
        }
        var nextStep = this._introItems[--this._currentStep];
        if (typeof(this._introBeforeChangeCallback) !== "undefined") {
            this._introBeforeChangeCallback.call(this, nextStep.element);
        }
        _showElement.call(this, nextStep);
    }

    function _exitIntro(targetElement) {
        var overlayLayer = targetElement.querySelector(".introjs-overlay");
        if (overlayLayer == null) {
            return;
        }
        overlayLayer.style.opacity = 0;
        setTimeout(function() {
            if (overlayLayer.parentNode) {
                overlayLayer.parentNode.removeChild(overlayLayer);
            }
        }, 500);
        var helperLayer = targetElement.querySelector(".introjs-helperLayer");
        if (helperLayer) {
            helperLayer.parentNode.removeChild(helperLayer);
        }
        var referenceLayer = targetElement.querySelector(".introjs-tooltipReferenceLayer");
        if (referenceLayer) {
            referenceLayer.parentNode.removeChild(referenceLayer);
        }
        var disableInteractionLayer = targetElement.querySelector(".introjs-disableInteraction");
        if (disableInteractionLayer) {
            disableInteractionLayer.parentNode.removeChild(disableInteractionLayer);
        }
        var floatingElement = document.querySelector(".introjsFloatingElement");
        if (floatingElement) {
            floatingElement.parentNode.removeChild(floatingElement);
        }
        var showElement = document.querySelector(".introjs-showElement");
        if (showElement) {
            showElement.className = showElement.className.replace(/introjs-[a-zA-Z]+/g, "").replace(/^\s+|\s+$/g, "");
        }
        var fixParents = document.querySelectorAll(".introjs-fixParent");
        if (fixParents && fixParents.length > 0) {
            for (var i = fixParents.length - 1; i >= 0; i--) {
                fixParents[i].className = fixParents[i].className.replace(/introjs-fixParent/g, "").replace(/^\s+|\s+$/g, "");
            }
        }
        if (window.removeEventListener) {
            window.removeEventListener("keydown", this._onKeyDown, true);
        } else {
            if (document.detachEvent) {
                document.detachEvent("onkeydown", this._onKeyDown);
            }
        }
        this._currentStep = undefined;
    }

    function _placeTooltip(targetElement, tooltipLayer, arrowLayer, helperNumberLayer, hintMode) {
        var tooltipCssClass = "",
            currentStepObj, tooltipOffset, targetOffset, windowSize, currentTooltipPosition;
        hintMode = hintMode || false;
        tooltipLayer.style.top = null;
        tooltipLayer.style.right = null;
        tooltipLayer.style.bottom = null;
        tooltipLayer.style.left = null;
        tooltipLayer.style.marginLeft = null;
        tooltipLayer.style.marginTop = null;
        arrowLayer.style.display = "inherit";
        if (typeof(helperNumberLayer) != "undefined" && helperNumberLayer != null) {
            helperNumberLayer.style.top = null;
            helperNumberLayer.style.left = null;
        }
        if (!this._introItems[this._currentStep]) {
            return;
        }
        currentStepObj = this._introItems[this._currentStep];
        if (typeof(currentStepObj.tooltipClass) === "string") {
            tooltipCssClass = currentStepObj.tooltipClass;
        } else {
            tooltipCssClass = this._options.tooltipClass;
        }
        tooltipLayer.className = ("introjs-tooltip " + tooltipCssClass).replace(/^\s+|\s+$/g, "");
        currentTooltipPosition = this._introItems[this._currentStep].position;
        if ((currentTooltipPosition == "auto" || this._options.tooltipPosition == "auto")) {
            if (currentTooltipPosition != "floating") {
                currentTooltipPosition = _determineAutoPosition.call(this, targetElement, tooltipLayer, currentTooltipPosition);
            }
        }
        targetOffset = _getOffset(targetElement);
        tooltipOffset = _getOffset(tooltipLayer);
        windowSize = _getWinSize();
        switch (currentTooltipPosition) {
            case "top":
                arrowLayer.className = "introjs-arrow bottom";
                if (hintMode) {
                    var tooltipLayerStyleLeft = 0;
                } else {
                    var tooltipLayerStyleLeft = 15;
                }
                _checkRight(targetOffset, tooltipLayerStyleLeft, tooltipOffset, windowSize, tooltipLayer);
                tooltipLayer.style.bottom = (targetOffset.height + 20) + "px";
                break;
            case "right":
                tooltipLayer.style.left = (targetOffset.width + 20) + "px";
                if (targetOffset.top + tooltipOffset.height > windowSize.height) {
                    arrowLayer.className = "introjs-arrow left-bottom";
                    tooltipLayer.style.top = "-" + (tooltipOffset.height - targetOffset.height - 20) + "px";
                } else {
                    arrowLayer.className = "introjs-arrow left";
                }
                break;
            case "left":
                if (!hintMode && this._options.showStepNumbers == true) {
                    tooltipLayer.style.top = "15px";
                }
                if (targetOffset.top + tooltipOffset.height > windowSize.height) {
                    tooltipLayer.style.top = "-" + (tooltipOffset.height - targetOffset.height - 20) + "px";
                    arrowLayer.className = "introjs-arrow right-bottom";
                } else {
                    arrowLayer.className = "introjs-arrow right";
                }
                tooltipLayer.style.right = (targetOffset.width + 20) + "px";
                break;
            case "floating":
                arrowLayer.style.display = "none";
                tooltipLayer.style.left = "50%";
                tooltipLayer.style.top = "50%";
                tooltipLayer.style.marginLeft = "-" + (tooltipOffset.width / 2) + "px";
                tooltipLayer.style.marginTop = "-" + (tooltipOffset.height / 2) + "px";
                if (typeof(helperNumberLayer) != "undefined" && helperNumberLayer != null) {
                    helperNumberLayer.style.left = "-" + ((tooltipOffset.width / 2) + 18) + "px";
                    helperNumberLayer.style.top = "-" + ((tooltipOffset.height / 2) + 18) + "px";
                }
                break;
            case "bottom-right-aligned":
                arrowLayer.className = "introjs-arrow top-right";
                var tooltipLayerStyleRight = 0;
                _checkLeft(targetOffset, tooltipLayerStyleRight, tooltipOffset, tooltipLayer);
                tooltipLayer.style.top = (targetOffset.height + 20) + "px";
                break;
            case "bottom-middle-aligned":
                arrowLayer.className = "introjs-arrow top-middle";
                var tooltipLayerStyleLeftRight = targetOffset.width / 2 - tooltipOffset.width / 2;
                if (hintMode) {
                    tooltipLayerStyleLeftRight += 5;
                }
                if (_checkLeft(targetOffset, tooltipLayerStyleLeftRight, tooltipOffset, tooltipLayer)) {
                    tooltipLayer.style.right = null;
                    _checkRight(targetOffset, tooltipLayerStyleLeftRight, tooltipOffset, windowSize, tooltipLayer);
                }
                tooltipLayer.style.top = (targetOffset.height + 20) + "px";
                break;
            case "bottom-left-aligned":
            case "bottom":
            default:
                arrowLayer.className = "introjs-arrow top";
                var tooltipLayerStyleLeft = 0;
                _checkRight(targetOffset, tooltipLayerStyleLeft, tooltipOffset, windowSize, tooltipLayer);
                tooltipLayer.style.top = (targetOffset.height + 20) + "px";
                break;
        }
    }

    function _checkRight(targetOffset, tooltipLayerStyleLeft, tooltipOffset, windowSize, tooltipLayer) {
        if (targetOffset.left + tooltipLayerStyleLeft + tooltipOffset.width > windowSize.width) {
            tooltipLayer.style.left = (windowSize.width - tooltipOffset.width - targetOffset.left) + "px";
            return false;
        }
        tooltipLayer.style.left = tooltipLayerStyleLeft + "px";
        return true;
    }

    function _checkLeft(targetOffset, tooltipLayerStyleRight, tooltipOffset, tooltipLayer) {
        if (targetOffset.left + targetOffset.width - tooltipLayerStyleRight - tooltipOffset.width < 0) {
            tooltipLayer.style.left = (-targetOffset.left) + "px";
            return false;
        }
        tooltipLayer.style.right = tooltipLayerStyleRight + "px";
        return true;
    }

    function _determineAutoPosition(targetElement, tooltipLayer, desiredTooltipPosition) {
        var possiblePositions = this._options.positionPrecedence.slice();
        var windowSize = _getWinSize();
        var tooltipHeight = _getOffset(tooltipLayer).height + 10;
        var tooltipWidth = _getOffset(tooltipLayer).width + 20;
        var targetOffset = _getOffset(targetElement);
        var calculatedPosition = "floating";
        if (targetOffset.left + tooltipWidth > windowSize.width || ((targetOffset.left + (targetOffset.width / 2)) - tooltipWidth) < 0) {
            _removeEntry(possiblePositions, "bottom");
            _removeEntry(possiblePositions, "top");
        } else {
            if ((targetOffset.height + targetOffset.top + tooltipHeight) > windowSize.height) {
                _removeEntry(possiblePositions, "bottom");
            }
            if (targetOffset.top - tooltipHeight < 0) {
                _removeEntry(possiblePositions, "top");
            }
        }
        if (targetOffset.width + targetOffset.left + tooltipWidth > windowSize.width) {
            _removeEntry(possiblePositions, "right");
        }
        if (targetOffset.left - tooltipWidth < 0) {
            _removeEntry(possiblePositions, "left");
        }
        if (possiblePositions.length > 0) {
            calculatedPosition = possiblePositions[0];
        }
        if (desiredTooltipPosition && desiredTooltipPosition != "auto") {
            if (possiblePositions.indexOf(desiredTooltipPosition) > -1) {
                calculatedPosition = desiredTooltipPosition;
            }
        }
        return calculatedPosition;
    }

    function _removeEntry(stringArray, stringToRemove) {
        if (stringArray.indexOf(stringToRemove) > -1) {
            stringArray.splice(stringArray.indexOf(stringToRemove), 1);
        }
    }

    function _setHelperLayerPosition(helperLayer) {
        if (helperLayer) {
            if (!this._introItems[this._currentStep]) {
                return;
            }
            var currentElement = this._introItems[this._currentStep],
                elementPosition = _getOffset(currentElement.element),
                widthHeightPadding = 10;
            if (_isFixed(currentElement.element)) {
                helperLayer.className += " introjs-fixedTooltip";
            }
            if (currentElement.position == "floating") {
                widthHeightPadding = 0;
            }
            helperLayer.setAttribute("style", "width: " + (elementPosition.width + widthHeightPadding) + "px; height:" + (elementPosition.height + widthHeightPadding) + "px; top:" + (elementPosition.top - 5) + "px;left: " + (elementPosition.left - 5) + "px;");
        }
    }

    function _disableInteraction() {
        var disableInteractionLayer = document.querySelector(".introjs-disableInteraction");
        if (disableInteractionLayer === null) {
            disableInteractionLayer = document.createElement("div");
            disableInteractionLayer.className = "introjs-disableInteraction";
            this._targetElement.appendChild(disableInteractionLayer);
            var self = this;
            disableInteractionLayer.onclick = function() {
                _exitIntro.call(self, self._targetElement);
            };
        }
        _setHelperLayerPosition.call(this, disableInteractionLayer);
    }

    function _showElement(targetElement) {
        $(".introjs-helperLayer").html("");
        if (typeof(this._introChangeCallback) !== "undefined") {
            this._introChangeCallback.call(this, targetElement.element);
        }
        var self = this,
            oldHelperLayer = document.querySelector(".introjs-helperLayer"),
            oldReferenceLayer = document.querySelector(".introjs-tooltipReferenceLayer"),
            highlightClass = "introjs-helperLayer",
            elementPosition = _getOffset(targetElement.element);
        if (typeof(targetElement.highlightClass) === "string") {
            highlightClass += (" " + targetElement.highlightClass);
        }
        if (typeof(this._options.highlightClass) === "string") {
            highlightClass += (" " + this._options.highlightClass);
        }
        if (oldHelperLayer != null) {
            var oldHelperNumberLayer = oldReferenceLayer.querySelector(".introjs-helperNumberLayer"),
                oldtooltipLayer = oldReferenceLayer.querySelector(".introjs-tooltiptext"),
                oldArrowLayer = oldReferenceLayer.querySelector(".introjs-arrow"),
                oldtooltipContainer = oldReferenceLayer.querySelector(".introjs-tooltip"),
                skipTooltipButton = oldReferenceLayer.querySelector(".introjs-skipbutton"),
                prevTooltipButton = oldReferenceLayer.querySelector(".introjs-prevbutton"),
                nextTooltipButton = oldReferenceLayer.querySelector(".introjs-nextbutton");
            oldHelperLayer.className = highlightClass;
            oldtooltipContainer.style.opacity = 0;
            oldtooltipContainer.style.display = "none";
            if (oldHelperNumberLayer != null) {
                var lastIntroItem = this._introItems[(targetElement.step - 2 >= 0 ? targetElement.step - 2 : 0)];
                if (lastIntroItem != null && (this._direction == "forward" && lastIntroItem.position == "floating") || (this._direction == "backward" && targetElement.position == "floating")) {
                    oldHelperNumberLayer.style.opacity = 0;
                }
            }
            _setHelperLayerPosition.call(self, oldHelperLayer);
            _setHelperLayerPosition.call(self, oldReferenceLayer);
            var fixParents = document.querySelectorAll(".introjs-fixParent");
            if (fixParents && fixParents.length > 0) {
                for (var i = fixParents.length - 1; i >= 0; i--) {
                    fixParents[i].className = fixParents[i].className.replace(/introjs-fixParent/g, "").replace(/^\s+|\s+$/g, "");
                }
            }
            var oldShowElement = document.querySelector(".introjs-showElement");
            oldShowElement.className = oldShowElement.className.replace(/introjs-[a-zA-Z]+/g, "").replace(/^\s+|\s+$/g, "");
            if (self._lastShowElementTimer) {
                clearTimeout(self._lastShowElementTimer);
            }
            self._lastShowElementTimer = setTimeout(function() {
                if (oldHelperNumberLayer != null) {
                    oldHelperNumberLayer.innerHTML = targetElement.step;
                }
                oldtooltipLayer.innerHTML = targetElement.intro;
                oldtooltipContainer.style.display = "block";
                _placeTooltip.call(self, targetElement.element, oldtooltipContainer, oldArrowLayer, oldHelperNumberLayer);
                oldReferenceLayer.querySelector(".introjs-bullets li > a.active").className = "";
                oldReferenceLayer.querySelector('.introjs-bullets li > a[data-stepnumber="' + targetElement.step + '"]').className = "active";
                oldReferenceLayer.querySelector(".introjs-progress .introjs-progressbar").setAttribute("style", "width:" + _getProgress.call(self) + "%;");
                oldtooltipContainer.style.opacity = 1;
                if (oldHelperNumberLayer) {
                    oldHelperNumberLayer.style.opacity = 1;
                }
                if (nextTooltipButton.tabIndex === -1) {
                    skipTooltipButton.focus();
                } else {
                    nextTooltipButton.focus();
                }
            }, 350);
        } else {
            var helperLayer = document.createElement("div"),
                referenceLayer = document.createElement("div"),
                arrowLayer = document.createElement("div"),
                tooltipLayer = document.createElement("div"),
                tooltipTextLayer = document.createElement("div"),
                bulletsLayer = document.createElement("div"),
                progressLayer = document.createElement("div"),
                buttonsLayer = document.createElement("div");
            helperLayer.className = highlightClass;
            referenceLayer.className = "introjs-tooltipReferenceLayer";
            _setHelperLayerPosition.call(self, helperLayer);
            _setHelperLayerPosition.call(self, referenceLayer);
            this._targetElement.appendChild(helperLayer);
            this._targetElement.appendChild(referenceLayer);
            arrowLayer.className = "introjs-arrow";
            tooltipTextLayer.className = "introjs-tooltiptext";
            tooltipTextLayer.innerHTML = targetElement.intro;
            bulletsLayer.className = "introjs-bullets";
            if (this._options.showBullets === false) {
                bulletsLayer.style.display = "none";
            }
            var ulContainer = document.createElement("ul");
            for (var i = 0, stepsLength = this._introItems.length; i < stepsLength; i++) {
                var innerLi = document.createElement("li");
                var anchorLink = document.createElement("a");
                anchorLink.onclick = function() {
                    self.goToStep(this.getAttribute("data-stepnumber"));
                };
                if (i === (targetElement.step - 1)) {
                    anchorLink.className = "active";
                }
                anchorLink.href = "javascript:void(0);";
                anchorLink.innerHTML = "&nbsp;";
                anchorLink.setAttribute("data-stepnumber", this._introItems[i].step);
                innerLi.appendChild(anchorLink);
                ulContainer.appendChild(innerLi);
            }
            bulletsLayer.appendChild(ulContainer);
            progressLayer.className = "introjs-progress";
            if (this._options.showProgress === false) {
                progressLayer.style.display = "none";
            }
            var progressBar = document.createElement("div");
            progressBar.className = "introjs-progressbar";
            progressBar.setAttribute("style", "width:" + _getProgress.call(this) + "%;");
            progressLayer.appendChild(progressBar);
            buttonsLayer.className = "introjs-tooltipbuttons";
            if (this._options.showButtons === false) {
                buttonsLayer.style.display = "none";
            }
            tooltipLayer.className = "introjs-tooltip";
            tooltipLayer.appendChild(tooltipTextLayer);
            tooltipLayer.appendChild(bulletsLayer);
            tooltipLayer.appendChild(progressLayer);
            if (this._options.showStepNumbers == true) {
                var helperNumberLayer = document.createElement("span");
                helperNumberLayer.className = "introjs-helperNumberLayer";
                helperNumberLayer.innerHTML = targetElement.step;
                referenceLayer.appendChild(helperNumberLayer);
            }
            tooltipLayer.appendChild(arrowLayer);
            referenceLayer.appendChild(tooltipLayer);
            var nextTooltipButton = document.createElement("a");
            nextTooltipButton.onclick = function() {
                if (self._introItems.length - 1 != self._currentStep) {
                    _nextStep.call(self);
                }
            };
            nextTooltipButton.href = "javascript:void(0);";
            nextTooltipButton.innerHTML = this._options.nextLabel;
            var prevTooltipButton = document.createElement("a");
            prevTooltipButton.onclick = function() {
                if (self._currentStep != 0) {
                    _previousStep.call(self);
                }
            };
            prevTooltipButton.href = "javascript:void(0);";
            prevTooltipButton.innerHTML = this._options.prevLabel;
            var skipTooltipButton = document.createElement("a");
            skipTooltipButton.className = "introjs-button introjs-skipbutton";
            skipTooltipButton.href = "javascript:void(0);";
            skipTooltipButton.innerHTML = this._options.skipLabel;
            skipTooltipButton.onclick = function() {
                if (self._introItems.length - 1 == self._currentStep && typeof(self._introCompleteCallback) === "function") {
                    self._introCompleteCallback.call(self);
                }
                if (self._introItems.length - 1 != self._currentStep && typeof(self._introExitCallback) === "function") {
                    self._introExitCallback.call(self);
                }
                _exitIntro.call(self, self._targetElement);
            };
            buttonsLayer.appendChild(skipTooltipButton);
            if (this._introItems.length > 1) {
                buttonsLayer.appendChild(prevTooltipButton);
                buttonsLayer.appendChild(nextTooltipButton);
            }
            tooltipLayer.appendChild(buttonsLayer);
            _placeTooltip.call(self, targetElement.element, tooltipLayer, arrowLayer, helperNumberLayer);
        }
        if (this._options.disableInteraction === true) {
            _disableInteraction.call(self);
        }
        prevTooltipButton.removeAttribute("tabIndex");
        nextTooltipButton.removeAttribute("tabIndex");
        if (this._currentStep == 0 && this._introItems.length > 1) {
            prevTooltipButton.className = "introjs-button introjs-prevbutton introjs-disabled";
            prevTooltipButton.tabIndex = "-1";
            nextTooltipButton.className = "introjs-button introjs-nextbutton";
            skipTooltipButton.innerHTML = this._options.skipLabel;
        } else {
            if (this._introItems.length - 1 == this._currentStep || this._introItems.length == 1) {
                skipTooltipButton.innerHTML = this._options.doneLabel;
                prevTooltipButton.className = "introjs-button introjs-prevbutton";
                nextTooltipButton.className = "introjs-button introjs-nextbutton introjs-disabled";
                nextTooltipButton.tabIndex = "-1";
            } else {
                prevTooltipButton.className = "introjs-button introjs-prevbutton";
                nextTooltipButton.className = "introjs-button introjs-nextbutton";
                skipTooltipButton.innerHTML = this._options.skipLabel;
            }
        }
        nextTooltipButton.focus();
        targetElement.element.className += " introjs-showElement";
        var currentElementPosition = _getPropValue(targetElement.element, "position");
        if (currentElementPosition !== "absolute" && currentElementPosition !== "relative") {
            targetElement.element.className += " introjs-relativePosition";
        }
        var parentElm = targetElement.element.parentNode;
        while (parentElm != null) {
            if (parentElm.tagName.toLowerCase() === "body") {
                break;
            }
            var zIndex = _getPropValue(parentElm, "z-index");
            var opacity = parseFloat(_getPropValue(parentElm, "opacity"));
            var transform = _getPropValue(parentElm, "transform") || _getPropValue(parentElm, "-webkit-transform") || _getPropValue(parentElm, "-moz-transform") || _getPropValue(parentElm, "-ms-transform") || _getPropValue(parentElm, "-o-transform");
            if (!targetElement.adjust) {
                if (/[0-9]+/.test(zIndex) || opacity < 1 || (transform !== "none" && transform !== undefined)) {
                    parentElm.className += " introjs-fixParent";
                }
            }
            parentElm = parentElm.parentNode;
        }
        if (!_elementInViewport(targetElement.element) && this._options.scrollToElement === true) {
            var rect = targetElement.element.getBoundingClientRect(),
                winHeight = _getWinSize().height,
                top = rect.bottom - (rect.bottom - rect.top),
                bottom = rect.bottom - winHeight;
            if (top < 0 || targetElement.element.clientHeight > winHeight) {
                $("html, body").animate({
                    scrollTop: $(targetElement.element).offset().top - 30
                }, 500);
            } else {
                $("html, body").animate({
                    scrollTop: bottom + 100
                }, 500);
            }
        }
        if (targetElement.adjust) {
            var _style = document.defaultView.getComputedStyle(targetElement.element, null);
            var _el = targetElement.element.cloneNode();
            manage_children(targetElement.element, _el);
            $(".introjs-helperLayer").append(_el);
        }
        if (typeof(this._introAfterChangeCallback) !== "undefined") {
            this._introAfterChangeCallback.call(this, targetElement.element);
        }
    }

    function _getPropValue(element, propName) {
        var propValue = "";
        if (element.currentStyle) {
            propValue = element.currentStyle[propName];
        } else {
            if (document.defaultView && document.defaultView.getComputedStyle) {
                propValue = document.defaultView.getComputedStyle(element, null).getPropertyValue(propName);
            }
        }
        if (propValue && propValue.toLowerCase) {
            return propValue.toLowerCase();
        } else {
            return propValue;
        }
    }

    function _isFixed(element) {
        var p = element.parentNode;
        if (p.nodeName === "HTML") {
            return false;
        }
        if (_getPropValue(element, "position") == "fixed") {
            return true;
        }
        return _isFixed(p);
    }

    function _getWinSize() {
        if (window.innerWidth != undefined) {
            return {
                width: window.innerWidth,
                height: window.innerHeight
            };
        } else {
            var D = document.documentElement;
            return {
                width: D.clientWidth,
                height: D.clientHeight
            };
        }
    }

    function _elementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (rect.top >= 0 && rect.left >= 0 && (rect.bottom + 80) <= window.innerHeight && rect.right <= window.innerWidth);
    }

    function _addOverlayLayer(targetElm) {
        var overlayLayer = document.createElement("div"),
            styleText = "",
            self = this;
        overlayLayer.className = "introjs-overlay";
        if (targetElm.tagName.toLowerCase() === "body") {
            styleText += "top: 0;bottom: 0; left: 0;right: 0;position: fixed;";
            overlayLayer.setAttribute("style", styleText);
        } else {
            var elementPosition = _getOffset(targetElm);
            if (elementPosition) {
                styleText += "width: " + elementPosition.width + "px; height:" + elementPosition.height + "px; top:" + elementPosition.top + "px;left: " + elementPosition.left + "px;";
                overlayLayer.setAttribute("style", styleText);
            }
        }
        targetElm.appendChild(overlayLayer);
        overlayLayer.onclick = function() {
            if (self._options.exitOnOverlayClick == true) {
                if (self._introExitCallback != undefined) {
                    self._introExitCallback.call(self);
                }
                _exitIntro.call(self, targetElm);
            }
        };
        setTimeout(function() {
            styleText += "opacity: " + self._options.overlayOpacity.toString() + ";";
            overlayLayer.setAttribute("style", styleText);
        }, 10);
        return true;
    }

    function _removeHintTooltip() {
        var tooltip = this._targetElement.querySelector(".introjs-hintReference");
        if (tooltip) {
            var step = tooltip.getAttribute("data-step");
            tooltip.parentNode.removeChild(tooltip);
            return step;
        }
    }

    function _populateHints(targetElm) {
        var self = this;
        this._introItems = [];
        if (this._options.hints) {
            for (var i = 0, l = this._options.hints.length; i < l; i++) {
                var currentItem = _cloneObject(this._options.hints[i]);
                if (typeof(currentItem.element) === "string") {
                    currentItem.element = document.querySelector(currentItem.element);
                }
                currentItem.hintPosition = currentItem.hintPosition || "top-middle";
                if (currentItem.element != null) {
                    this._introItems.push(currentItem);
                }
            }
        } else {
            var hints = targetElm.querySelectorAll("*[data-hint]");
            if (hints.length < 1) {
                return false;
            }
            for (var i = 0, l = hints.length; i < l; i++) {
                var currentElement = hints[i];
                this._introItems.push({
                    element: currentElement,
                    hint: currentElement.getAttribute("data-hint"),
                    hintPosition: currentElement.getAttribute("data-hintPosition") || this._options.hintPosition,
                    tooltipClass: currentElement.getAttribute("data-tooltipClass"),
                    position: currentElement.getAttribute("data-position") || this._options.tooltipPosition
                });
            }
        }
        _addHints.call(this);
        if (document.addEventListener) {
            document.addEventListener("click", _removeHintTooltip.bind(this), false);
            window.addEventListener("resize", _reAlignHints.bind(this), true);
        } else {
            if (document.attachEvent) {
                document.attachEvent("onclick", _removeHintTooltip.bind(this));
                document.attachEvent("onresize", _reAlignHints.bind(this));
            }
        }
    }

    function _reAlignHints() {
        for (var i = 0, l = this._introItems.length; i < l; i++) {
            var item = this._introItems[i];
            _alignHintPosition.call(this, item.hintPosition, item.element, item.targetElement);
        }
    }

    function _hideHint(stepId) {
        _removeHintTooltip.call(this);
        var hint = this._targetElement.querySelector('.introjs-hint[data-step="' + stepId + '"]');
        if (hint) {
            hint.className += " introjs-hidehint";
        }
        if (typeof(this._hintCloseCallback) !== "undefined") {
            this._hintCloseCallback.call(this, stepId);
        }
    }

    function _addHints() {
        var self = this;
        var oldHintsWrapper = document.querySelector(".introjs-hints");
        if (oldHintsWrapper != null) {
            hintsWrapper = oldHintsWrapper;
        } else {
            var hintsWrapper = document.createElement("div");
            hintsWrapper.className = "introjs-hints";
        }
        for (var i = 0, l = this._introItems.length; i < l; i++) {
            var item = this._introItems[i];
            if (document.querySelector('.introjs-hint[data-step="' + i + '"]')) {
                continue;
            }
            var hint = document.createElement("a");
            hint.href = "javascript:void(0);";
            (function(hint, item, i) {
                hint.onclick = function(e) {
                    var evt = e ? e : window.event;
                    if (evt.stopPropagation) {
                        evt.stopPropagation();
                    }
                    if (evt.cancelBubble != null) {
                        evt.cancelBubble = true;
                    }
                    _hintClick.call(self, hint, item, i);
                };
            }(hint, item, i));
            hint.className = "introjs-hint";
            if (_isFixed(item.element)) {
                hint.className += " introjs-fixedhint";
            }
            var hintDot = document.createElement("div");
            hintDot.className = "introjs-hint-dot";
            var hintPulse = document.createElement("div");
            hintPulse.className = "introjs-hint-pulse";
            hint.appendChild(hintDot);
            hint.appendChild(hintPulse);
            hint.setAttribute("data-step", i);
            item.targetElement = item.element;
            item.element = hint;
            _alignHintPosition.call(this, item.hintPosition, hint, item.targetElement);
            hintsWrapper.appendChild(hint);
        }
        document.body.appendChild(hintsWrapper);
        if (typeof(this._hintsAddedCallback) !== "undefined") {
            this._hintsAddedCallback.call(this);
        }
    }

    function _alignHintPosition(position, hint, element) {
        var offset = _getOffset.call(this, element);
        switch (position) {
            default:
                case "top-left":
                hint.style.left = offset.left + "px";hint.style.top = offset.top + "px";
            break;
            case "top-right":
                    hint.style.left = (offset.left + offset.width) + "px";hint.style.top = offset.top + "px";
                break;
            case "bottom-left":
                    hint.style.left = offset.left + "px";hint.style.top = (offset.top + offset.height) + "px";
                break;
            case "bottom-right":
                    hint.style.left = (offset.left + offset.width) + "px";hint.style.top = (offset.top + offset.height) + "px";
                break;
            case "bottom-middle":
                    hint.style.left = (offset.left + (offset.width / 2)) + "px";hint.style.top = (offset.top + offset.height) + "px";
                break;
            case "top-middle":
                    hint.style.left = (offset.left + (offset.width / 2)) + "px";hint.style.top = offset.top + "px";
                break;
        }
    }

    function _hintClick(hintElement, item, stepId) {
        if (typeof(this._hintClickCallback) !== "undefined") {
            this._hintClickCallback.call(this, hintElement, item, stepId);
        }
        var removedStep = _removeHintTooltip.call(this);
        if (parseInt(removedStep, 10) == stepId) {
            return;
        }
        var tooltipLayer = document.createElement("div");
        var tooltipTextLayer = document.createElement("div");
        var arrowLayer = document.createElement("div");
        var referenceLayer = document.createElement("div");
        tooltipLayer.className = "introjs-tooltip";
        tooltipLayer.onclick = function(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            } else {
                e.cancelBubble = true;
            }
        };
        tooltipTextLayer.className = "introjs-tooltiptext";
        var tooltipWrapper = document.createElement("p");
        tooltipWrapper.innerHTML = item.hint;
        var closeButton = document.createElement("a");
        closeButton.className = "introjs-button";
        closeButton.innerHTML = this._options.hintButtonLabel;
        closeButton.onclick = _hideHint.bind(this, stepId);
        tooltipTextLayer.appendChild(tooltipWrapper);
        tooltipTextLayer.appendChild(closeButton);
        arrowLayer.className = "introjs-arrow";
        tooltipLayer.appendChild(arrowLayer);
        tooltipLayer.appendChild(tooltipTextLayer);
        this._currentStep = hintElement.getAttribute("data-step");
        referenceLayer.className = "introjs-tooltipReferenceLayer introjs-hintReference";
        referenceLayer.setAttribute("data-step", hintElement.getAttribute("data-step"));
        _setHelperLayerPosition.call(this, referenceLayer);
        referenceLayer.appendChild(tooltipLayer);
        document.body.appendChild(referenceLayer);
        _placeTooltip.call(this, hintElement, tooltipLayer, arrowLayer, null, true);
    }

    function _getOffset(element) {
        var elementPosition = {};
        elementPosition.width = element.offsetWidth;
        elementPosition.height = element.offsetHeight;
        var _x = 0;
        var _y = 0;
        var _has_ps_container = false;
        var error_margin_for_top = 0;
        var el_with_ps = false;
        while (element && !isNaN(element.offsetLeft) && !isNaN(element.offsetTop)) {
            if ($(element).hasClass("ps-container")) {
                error_margin_for_top = $(element).offset().top;
                el_with_ps = element;
                _has_ps_container = true;
            }
            _x += element.offsetLeft;
            _y += element.offsetTop;
            element = element.offsetParent;
        }
        elementPosition.top = _y;
        elementPosition.left = _x;
        if (_has_ps_container) {
            elementPosition.top = _y - $(el_with_ps).scrollTop();
        }
        return elementPosition;
    }

    function _getProgress() {
        var currentStep = parseInt((this._currentStep + 1), 10);
        return ((currentStep / this._introItems.length) * 100);
    }

    function _mergeOptions(obj1, obj2) {
        var obj3 = {};
        for (var attrname in obj1) {
            obj3[attrname] = obj1[attrname];
        }
        for (var attrname in obj2) {
            obj3[attrname] = obj2[attrname];
        }
        return obj3;
    }
    var introJs = function(targetElm) {
        if (typeof(targetElm) === "object") {
            return new IntroJs(targetElm);
        } else {
            if (typeof(targetElm) === "string") {
                var targetElement = document.querySelector(targetElm);
                if (targetElement) {
                    return new IntroJs(targetElement);
                } else {
                    throw new Error("There is no element with given selector.");
                }
            } else {
                return new IntroJs(document.body);
            }
        }
    };
    introJs.version = VERSION;
    introJs.fn = IntroJs.prototype = {
        clone: function() {
            return new IntroJs(this);
        },
        setOption: function(option, value) {
            this._options[option] = value;
            return this;
        },
        setOptions: function(options) {
            this._options = _mergeOptions(this._options, options);
            return this;
        },
        start: function() {
            _introForElement.call(this, this._targetElement);
            return this;
        },
        goToStep: function(step) {
            _goToStep.call(this, step);
            return this;
        },
        nextStep: function() {
            _nextStep.call(this);
            return this;
        },
        previousStep: function() {
            _previousStep.call(this);
            return this;
        },
        exit: function() {
            _exitIntro.call(this, this._targetElement);
            return this;
        },
        refresh: function() {
            _setHelperLayerPosition.call(this, document.querySelector(".introjs-helperLayer"));
            _setHelperLayerPosition.call(this, document.querySelector(".introjs-tooltipReferenceLayer"));
            return this;
        },
        onbeforechange: function(providedCallback) {
            if (typeof(providedCallback) === "function") {
                this._introBeforeChangeCallback = providedCallback;
            } else {
                throw new Error("Provided callback for onbeforechange was not a function");
            }
            return this;
        },
        onchange: function(providedCallback) {
            if (typeof(providedCallback) === "function") {
                this._introChangeCallback = providedCallback;
            } else {
                throw new Error("Provided callback for onchange was not a function.");
            }
            return this;
        },
        onafterchange: function(providedCallback) {
            if (typeof(providedCallback) === "function") {
                this._introAfterChangeCallback = providedCallback;
            } else {
                throw new Error("Provided callback for onafterchange was not a function");
            }
            return this;
        },
        oncomplete: function(providedCallback) {
            if (typeof(providedCallback) === "function") {
                this._introCompleteCallback = providedCallback;
            } else {
                throw new Error("Provided callback for oncomplete was not a function.");
            }
            return this;
        },
        onhintsadded: function(providedCallback) {
            if (typeof(providedCallback) === "function") {
                this._hintsAddedCallback = providedCallback;
            } else {
                throw new Error("Provided callback for onhintsadded was not a function.");
            }
            return this;
        },
        onhintclick: function(providedCallback) {
            if (typeof(providedCallback) === "function") {
                this._hintClickCallback = providedCallback;
            } else {
                throw new Error("Provided callback for onhintclick was not a function.");
            }
            return this;
        },
        onhintclose: function(providedCallback) {
            if (typeof(providedCallback) === "function") {
                this._hintCloseCallback = providedCallback;
            } else {
                throw new Error("Provided callback for onhintclose was not a function.");
            }
            return this;
        },
        onexit: function(providedCallback) {
            if (typeof(providedCallback) === "function") {
                this._introExitCallback = providedCallback;
            } else {
                throw new Error("Provided callback for onexit was not a function.");
            }
            return this;
        },
        addHints: function() {
            _populateHints.call(this, this._targetElement);
            return this;
        }
    };
    exports.introJs = introJs;
    return introJs;
}));
var manage_children = function(el, created_el) {
    if (el.nodeType == 3) {
        $(created_el).append(el);
        return;
    }
    var _children = el.childNodes;
    var _style = document.defaultView.getComputedStyle(el, null);
    var _new_style = {};
    for (i in _style) {
        if (typeof _style[i] == "string") {
            if (_style[i]) {
                try {
                    _new_style[i] = _style[i];
                } catch (e) {}
            }
        }
    }
    $(created_el).css(_new_style);
    $(_children).each(function(index, _child) {
        var _el = _child.cloneNode();
        $(created_el).append(_el);
        if (_child.hasChildNodes()) {
            manage_children(_child, _el);
        }
    });
};
$(document).ajaxError(function(event, jqxhr, settings, thrownError) {});
$(document).ready(function() {
    $(document).on("focus", "input[type=text]", function() {
        $(this).addClass("typing");
    });
    $(document).on("blur", "input[type=text]", function() {
        $(this).removeClass("typing");
    });
    $(document).on("click", ".fa-calendar", function() {
        $(this).next("input").focus();
    });
});

function loadpopunderBottomLeft(param_arr) {
    var options = {
        windowwidth: 200,
        windowheight: 200,
        window_url: ""
    };
    $.extend(options, param_arr);
    var windowwidth = options.windowwidth;
    var windowheight = options.windowheight;
    var windowwidth = screen.availWidth / 8;
    var windowheight = screen.availHeight / 4;
    var window_url = options.window_url;
    var newwin = window.open(window_url, "Book Hotel", "width=" + windowwidth + ",height=" + windowheight + ", directories=no,menubar=no, toolbar=no,scrollbars=yes");
    var screenwidth = screen.availWidth + 100;
    var screenheight = screen.availHeight;
    if (newwin.length == 0) {
        newwin.moveTo(screenwidth - windowwidth, screenheight - windowheight);
    }
    setTimeout(function() {
        newwin.blur();
    }, 200);
}

function loadpopunderBottomRight(param_arr) {
    var options = {
        windowwidth: 200,
        windowheight: 200,
        window_url: joguru.base + "create-your-itinerary"
    };
    $.extend(options, param_arr);
    var windowwidth = options.windowwidth;
    var windowheight = options.windowheight;
    var windowwidth = screen.availWidth / 4;
    var windowheight = screen.availHeight / 4;
    var window_url = options.window_url;
    window_url = window_url.replace(joguru.base, joguru.base + "create-your-itinerary");
    var newwin = window.open(window_url, "Create Itinerary", "width=" + windowwidth + ",height=" + windowheight + ",directories=no,menubar=no, toolbar=no,scrollbars=yes");
    var screenwidth = screen.availWidth;
    var screenheight = screen.availHeight;
    if (newwin.length == 0) {
        newwin.moveTo(screenwidth - windowwidth, screenheight - windowheight);
    }
    setTimeout(function() {
        newwin.blur();
    }, 200);
    loadPopunderWindow = newwin;
}

function loadpopunder() {
    var popunder = joguru.base + "create-your-itinerary/?utm_source=blog_pu&utm_medium=triphoboblog&utm_campaign=blog_counter";
    var newWin = window.open(joguru.base + "blog", "_blank");
    if (!newWin || newWin.closed || typeof newWin.closed == "undefined") {
        window.open(popunder, "_blank");
    } else {
        setTimeout(function() {
            location.href = popunder;
        }, 400);
    }
}

function createCookie(name, value, hours) {
    if (hours) {
        var date = new Date();
        date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
        var expires = "; expires=" + date.toString();
    } else {
        var expires = "";
    }
    document.cookie = name + "=" + value + expires + "; domain=.triphobo.com; path=/";
}

function delete_cookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT; domain=.triphobo.com; path=/";
}

function getCookie(c_name) {
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1) {
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1) {
        c_value = null;
    } else {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1) {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
}
$(document).off("click", ".js_iti_create_popunder").on("click", ".js_iti_create_popunder", function() {
    loadpopunderBottomRight({
        window_url: joguru.base
    });
    if (getCookie("blog_loadpopunder") == null) {
        createCookie("blog_loadpopunder", 1, 2);
    }
});

function globalPopunder(param_arr) {
    var options = {
        windowwidth: 150,
        windowheight: 150,
        window_url: joguru.base + "create-your-itinerary"
    };
    $.extend(options, param_arr);
    var windowwidth = options.windowwidth;
    var windowheight = options.windowheight;
    var window_url = options.window_url;
    var newwin = window.open(window_url, "Create Itinerary", "width=" + windowwidth + ",height=" + windowheight + ",directories=no,menubar=no, toolbar=no,scrollbars=yes");
    var screenwidth = screen.availWidth;
    var screenheight = screen.availHeight;
    if (newwin.length == 0) {
        createCookie("openglobalPopunder", 1, 5);
        createCookie("resizeGlobalPopunder", 1, 5);
        createCookie("globalPopunderPageUrl", window.location.href, 1);
        newwin.moveTo(screenwidth - windowwidth, screenheight - windowheight);
    }
    globalPopunderWindow = newwin;
}

function globalRightSidePopup(param_arr) {
    var options = {
        windowwidth: 150,
        windowheight: 150,
        window_url: joguru.base + "create-your-itinerary"
    };
    $.extend(options, param_arr);
    var windowwidth = options.windowwidth;
    var windowheight = options.windowheight;
    var window_url = options.window_url;
    var newwin = window.open(window_url, "Create Itinerary", "width=" + windowwidth + ",height=" + windowheight + ",directories=no,menubar=no, toolbar=no,scrollbars=yes");
    var screenwidth = screen.availWidth;
    var screenheight = screen.availHeight;
    if (newwin.length == 0) {
        newwin.moveTo(screenwidth - windowwidth, screenheight - windowheight);
    }
}! function(t, e) {
    "object" == typeof exports && "object" == typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : "object" == typeof exports ? exports.Handlebars = e() : t.Handlebars = e()
}(this, function() {
    return function(t) {
        function e(s) {
            if (r[s]) return r[s].exports;
            var i = r[s] = {
                exports: {},
                id: s,
                loaded: !1
            };
            return t[s].call(i.exports, i, i.exports, e), i.loaded = !0, i.exports
        }
        var r = {};
        return e.m = t, e.c = r, e.p = "", e(0)
    }([function(t, e, r) {
        "use strict";

        function s() {
            var t = v();
            return t.compile = function(e, r) {
                return l.compile(e, r, t)
            }, t.precompile = function(e, r) {
                return l.precompile(e, r, t)
            }, t.AST = c["default"], t.Compiler = l.Compiler, t.JavaScriptCompiler = u["default"], t.Parser = h.parser, t.parse = h.parse, t
        }
        var i = r(8)["default"];
        e.__esModule = !0;
        var a = r(1),
            n = i(a),
            o = r(2),
            c = i(o),
            h = r(3),
            l = r(4),
            p = r(5),
            u = i(p),
            f = r(6),
            d = i(f),
            m = r(7),
            g = i(m),
            v = n["default"].create,
            y = s();
        y.create = s, g["default"](y), y.Visitor = d["default"], y["default"] = y, e["default"] = y, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";

        function s() {
            var t = new o.HandlebarsEnvironment;
            return f.extend(t, o), t.SafeString = h["default"], t.Exception = p["default"], t.Utils = f, t.escapeExpression = f.escapeExpression, t.VM = m, t.template = function(e) {
                return m.template(e, t)
            }, t
        }
        var i = r(9)["default"],
            a = r(8)["default"];
        e.__esModule = !0;
        var n = r(10),
            o = i(n),
            c = r(11),
            h = a(c),
            l = r(12),
            p = a(l),
            u = r(13),
            f = i(u),
            d = r(14),
            m = i(d),
            g = r(7),
            v = a(g),
            y = s();
        y.create = s, v["default"](y), y["default"] = y, e["default"] = y, t.exports = e["default"]
    }, function(t, e) {
        "use strict";
        e.__esModule = !0;
        var r = {
            helpers: {
                helperExpression: function(t) {
                    return "SubExpression" === t.type || ("MustacheStatement" === t.type || "BlockStatement" === t.type) && !!(t.params && t.params.length || t.hash)
                },
                scopedId: function(t) {
                    return /^\.|this\b/.test(t.original)
                },
                simpleId: function(t) {
                    return 1 === t.parts.length && !r.helpers.scopedId(t) && !t.depth
                }
            }
        };
        e["default"] = r, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";

        function s(t, e) {
            if ("Program" === t.type) return t;
            o["default"].yy = f, f.locInfo = function(t) {
                return new f.SourceLocation(e && e.srcName, t)
            };
            var r = new h["default"](e);
            return r.accept(o["default"].parse(t))
        }
        var i = r(8)["default"],
            a = r(9)["default"];
        e.__esModule = !0, e.parse = s;
        var n = r(15),
            o = i(n),
            c = r(16),
            h = i(c),
            l = r(17),
            p = a(l),
            u = r(13);
        e.parser = o["default"];
        var f = {};
        u.extend(f, p)
    }, function(t, e, r) {
        "use strict";

        function s() {}

        function i(t, e, r) {
            if (null == t || "string" != typeof t && "Program" !== t.type) throw new l["default"]("You must pass a string or Handlebars AST to Handlebars.precompile. You passed " + t);
            e = e || {}, "data" in e || (e.data = !0), e.compat && (e.useDepths = !0);
            var s = r.parse(t, e),
                i = (new r.Compiler).compile(s, e);
            return (new r.JavaScriptCompiler).compile(i, e)
        }

        function a(t, e, r) {
            function s() {
                var s = r.parse(t, e),
                    i = (new r.Compiler).compile(s, e),
                    a = (new r.JavaScriptCompiler).compile(i, e, void 0, !0);
                return r.template(a)
            }

            function i(t, e) {
                return a || (a = s()), a.call(this, t, e)
            }
            if (void 0 === e && (e = {}), null == t || "string" != typeof t && "Program" !== t.type) throw new l["default"]("You must pass a string or Handlebars AST to Handlebars.compile. You passed " + t);
            "data" in e || (e.data = !0), e.compat && (e.useDepths = !0);
            var a = void 0;
            return i._setup = function(t) {
                return a || (a = s()), a._setup(t)
            }, i._child = function(t, e, r, i) {
                return a || (a = s()), a._child(t, e, r, i)
            }, i
        }

        function n(t, e) {
            if (t === e) return !0;
            if (p.isArray(t) && p.isArray(e) && t.length === e.length) {
                for (var r = 0; r < t.length; r++)
                    if (!n(t[r], e[r])) return !1;
                return !0
            }
        }

        function o(t) {
            if (!t.path.parts) {
                var e = t.path;
                t.path = {
                    type: "PathExpression",
                    data: !1,
                    depth: 0,
                    parts: [e.original + ""],
                    original: e.original + "",
                    loc: e.loc
                }
            }
        }
        var c = r(8)["default"];
        e.__esModule = !0, e.Compiler = s, e.precompile = i, e.compile = a;
        var h = r(12),
            l = c(h),
            p = r(13),
            u = r(2),
            f = c(u),
            d = [].slice;
        s.prototype = {
            compiler: s,
            equals: function(t) {
                var e = this.opcodes.length;
                if (t.opcodes.length !== e) return !1;
                for (var r = 0; e > r; r++) {
                    var s = this.opcodes[r],
                        i = t.opcodes[r];
                    if (s.opcode !== i.opcode || !n(s.args, i.args)) return !1
                }
                e = this.children.length;
                for (var r = 0; e > r; r++)
                    if (!this.children[r].equals(t.children[r])) return !1;
                return !0
            },
            guid: 0,
            compile: function(t, e) {
                this.sourceNode = [], this.opcodes = [], this.children = [], this.options = e, this.stringParams = e.stringParams, this.trackIds = e.trackIds, e.blockParams = e.blockParams || [];
                var r = e.knownHelpers;
                if (e.knownHelpers = {
                        helperMissing: !0,
                        blockHelperMissing: !0,
                        each: !0,
                        "if": !0,
                        unless: !0,
                        "with": !0,
                        log: !0,
                        lookup: !0
                    }, r)
                    for (var s in r) s in r && (e.knownHelpers[s] = r[s]);
                return this.accept(t)
            },
            compileProgram: function(t) {
                var e = new this.compiler,
                    r = e.compile(t, this.options),
                    s = this.guid++;
                return this.usePartial = this.usePartial || r.usePartial, this.children[s] = r, this.useDepths = this.useDepths || r.useDepths, s
            },
            accept: function(t) {
                if (!this[t.type]) throw new l["default"]("Unknown type: " + t.type, t);
                this.sourceNode.unshift(t);
                var e = this[t.type](t);
                return this.sourceNode.shift(), e
            },
            Program: function(t) {
                this.options.blockParams.unshift(t.blockParams);
                for (var e = t.body, r = e.length, s = 0; r > s; s++) this.accept(e[s]);
                return this.options.blockParams.shift(), this.isSimple = 1 === r, this.blockParams = t.blockParams ? t.blockParams.length : 0, this
            },
            BlockStatement: function(t) {
                o(t);
                var e = t.program,
                    r = t.inverse;
                e = e && this.compileProgram(e), r = r && this.compileProgram(r);
                var s = this.classifySexpr(t);
                "helper" === s ? this.helperSexpr(t, e, r) : "simple" === s ? (this.simpleSexpr(t), this.opcode("pushProgram", e), this.opcode("pushProgram", r), this.opcode("emptyHash"), this.opcode("blockValue", t.path.original)) : (this.ambiguousSexpr(t, e, r), this.opcode("pushProgram", e), this.opcode("pushProgram", r), this.opcode("emptyHash"), this.opcode("ambiguousBlockValue")), this.opcode("append")
            },
            DecoratorBlock: function(t) {
                var e = t.program && this.compileProgram(t.program),
                    r = this.setupFullMustacheParams(t, e, void 0),
                    s = t.path;
                this.useDecorators = !0, this.opcode("registerDecorator", r.length, s.original)
            },
            PartialStatement: function(t) {
                this.usePartial = !0;
                var e = t.program;
                e && (e = this.compileProgram(t.program));
                var r = t.params;
                if (r.length > 1) throw new l["default"]("Unsupported number of partial arguments: " + r.length, t);
                r.length || (this.options.explicitPartialContext ? this.opcode("pushLiteral", "undefined") : r.push({
                    type: "PathExpression",
                    parts: [],
                    depth: 0
                }));
                var s = t.name.original,
                    i = "SubExpression" === t.name.type;
                i && this.accept(t.name), this.setupFullMustacheParams(t, e, void 0, !0);
                var a = t.indent || "";
                this.options.preventIndent && a && (this.opcode("appendContent", a), a = ""), this.opcode("invokePartial", i, s, a), this.opcode("append")
            },
            PartialBlockStatement: function(t) {
                this.PartialStatement(t)
            },
            MustacheStatement: function(t) {
                this.SubExpression(t), t.escaped && !this.options.noEscape ? this.opcode("appendEscaped") : this.opcode("append")
            },
            Decorator: function(t) {
                this.DecoratorBlock(t)
            },
            ContentStatement: function(t) {
                t.value && this.opcode("appendContent", t.value)
            },
            CommentStatement: function() {},
            SubExpression: function(t) {
                o(t);
                var e = this.classifySexpr(t);
                "simple" === e ? this.simpleSexpr(t) : "helper" === e ? this.helperSexpr(t) : this.ambiguousSexpr(t)
            },
            ambiguousSexpr: function(t, e, r) {
                var s = t.path,
                    i = s.parts[0],
                    a = null != e || null != r;
                this.opcode("getContext", s.depth), this.opcode("pushProgram", e), this.opcode("pushProgram", r), s.strict = !0, this.accept(s), this.opcode("invokeAmbiguous", i, a)
            },
            simpleSexpr: function(t) {
                var e = t.path;
                e.strict = !0, this.accept(e), this.opcode("resolvePossibleLambda")
            },
            helperSexpr: function(t, e, r) {
                var s = this.setupFullMustacheParams(t, e, r),
                    i = t.path,
                    a = i.parts[0];
                if (this.options.knownHelpers[a]) this.opcode("invokeKnownHelper", s.length, a);
                else {
                    if (this.options.knownHelpersOnly) throw new l["default"]("You specified knownHelpersOnly, but used the unknown helper " + a, t);
                    i.strict = !0, i.falsy = !0, this.accept(i), this.opcode("invokeHelper", s.length, i.original, f["default"].helpers.simpleId(i))
                }
            },
            PathExpression: function(t) {
                this.addDepth(t.depth), this.opcode("getContext", t.depth);
                var e = t.parts[0],
                    r = f["default"].helpers.scopedId(t),
                    s = !t.depth && !r && this.blockParamIndex(e);
                s ? this.opcode("lookupBlockParam", s, t.parts) : e ? t.data ? (this.options.data = !0, this.opcode("lookupData", t.depth, t.parts, t.strict)) : this.opcode("lookupOnContext", t.parts, t.falsy, t.strict, r) : this.opcode("pushContext")
            },
            StringLiteral: function(t) {
                this.opcode("pushString", t.value)
            },
            NumberLiteral: function(t) {
                this.opcode("pushLiteral", t.value)
            },
            BooleanLiteral: function(t) {
                this.opcode("pushLiteral", t.value)
            },
            UndefinedLiteral: function() {
                this.opcode("pushLiteral", "undefined")
            },
            NullLiteral: function() {
                this.opcode("pushLiteral", "null")
            },
            Hash: function(t) {
                var e = t.pairs,
                    r = 0,
                    s = e.length;
                for (this.opcode("pushHash"); s > r; r++) this.pushParam(e[r].value);
                for (; r--;) this.opcode("assignToHash", e[r].key);
                this.opcode("popHash")
            },
            opcode: function(t) {
                this.opcodes.push({
                    opcode: t,
                    args: d.call(arguments, 1),
                    loc: this.sourceNode[0].loc
                })
            },
            addDepth: function(t) {
                t && (this.useDepths = !0)
            },
            classifySexpr: function(t) {
                var e = f["default"].helpers.simpleId(t.path),
                    r = e && !!this.blockParamIndex(t.path.parts[0]),
                    s = !r && f["default"].helpers.helperExpression(t),
                    i = !r && (s || e);
                if (i && !s) {
                    var a = t.path.parts[0],
                        n = this.options;
                    n.knownHelpers[a] ? s = !0 : n.knownHelpersOnly && (i = !1)
                }
                return s ? "helper" : i ? "ambiguous" : "simple"
            },
            pushParams: function(t) {
                for (var e = 0, r = t.length; r > e; e++) this.pushParam(t[e])
            },
            pushParam: function(t) {
                var e = null != t.value ? t.value : t.original || "";
                if (this.stringParams) e.replace && (e = e.replace(/^(\.?\.\/)*/g, "").replace(/\//g, ".")), t.depth && this.addDepth(t.depth), this.opcode("getContext", t.depth || 0), this.opcode("pushStringParam", e, t.type), "SubExpression" === t.type && this.accept(t);
                else {
                    if (this.trackIds) {
                        var r = void 0;
                        if (!t.parts || f["default"].helpers.scopedId(t) || t.depth || (r = this.blockParamIndex(t.parts[0])), r) {
                            var s = t.parts.slice(1).join(".");
                            this.opcode("pushId", "BlockParam", r, s)
                        } else e = t.original || e, e.replace && (e = e.replace(/^this(?:\.|$)/, "").replace(/^\.\//, "").replace(/^\.$/, "")), this.opcode("pushId", t.type, e)
                    }
                    this.accept(t)
                }
            },
            setupFullMustacheParams: function(t, e, r, s) {
                var i = t.params;
                return this.pushParams(i), this.opcode("pushProgram", e), this.opcode("pushProgram", r), t.hash ? this.accept(t.hash) : this.opcode("emptyHash", s), i
            },
            blockParamIndex: function(t) {
                for (var e = 0, r = this.options.blockParams.length; r > e; e++) {
                    var s = this.options.blockParams[e],
                        i = s && p.indexOf(s, t);
                    if (s && i >= 0) return [e, i]
                }
            }
        }
    }, function(t, e, r) {
        "use strict";

        function s(t) {
            this.value = t
        }

        function i() {}

        function a(t, e, r, s) {
            var i = e.popStack(),
                a = 0,
                n = r.length;
            for (t && n--; n > a; a++) i = e.nameLookup(i, r[a], s);
            return t ? [e.aliasable("container.strict"), "(", i, ", ", e.quotedString(r[a]), ")"] : i
        }
        var n = r(8)["default"];
        e.__esModule = !0;
        var o = r(10),
            c = r(12),
            h = n(c),
            l = r(13),
            p = r(18),
            u = n(p);
        i.prototype = {
                nameLookup: function(t, e) {
                    return i.isValidJavaScriptVariableName(e) ? [t, ".", e] : [t, "[", JSON.stringify(e), "]"]
                },
                depthedLookup: function(t) {
                    return [this.aliasable("container.lookup"), '(depths, "', t, '")']
                },
                compilerInfo: function() {
                    var t = o.COMPILER_REVISION,
                        e = o.REVISION_CHANGES[t];
                    return [t, e]
                },
                appendToBuffer: function(t, e, r) {
                    return l.isArray(t) || (t = [t]), t = this.source.wrap(t, e), this.environment.isSimple ? ["return ", t, ";"] : r ? ["buffer += ", t, ";"] : (t.appendToBuffer = !0, t)
                },
                initializeBuffer: function() {
                    return this.quotedString("")
                },
                compile: function(t, e, r, s) {
                    this.environment = t, this.options = e, this.stringParams = this.options.stringParams, this.trackIds = this.options.trackIds, this.precompile = !s, this.name = this.environment.name, this.isChild = !!r, this.context = r || {
                        decorators: [],
                        programs: [],
                        environments: []
                    }, this.preamble(), this.stackSlot = 0, this.stackVars = [], this.aliases = {}, this.registers = {
                        list: []
                    }, this.hashes = [], this.compileStack = [], this.inlineStack = [], this.blockParams = [], this.compileChildren(t, e), this.useDepths = this.useDepths || t.useDepths || t.useDecorators || this.options.compat, this.useBlockParams = this.useBlockParams || t.useBlockParams;
                    var i = t.opcodes,
                        a = void 0,
                        n = void 0,
                        o = void 0,
                        c = void 0;
                    for (o = 0, c = i.length; c > o; o++) a = i[o], this.source.currentLocation = a.loc, n = n || a.loc, this[a.opcode].apply(this, a.args);
                    if (this.source.currentLocation = n, this.pushSource(""), this.stackSlot || this.inlineStack.length || this.compileStack.length) throw new h["default"]("Compile completed with content left on stack");
                    this.decorators.isEmpty() ? this.decorators = void 0 : (this.useDecorators = !0, this.decorators.prepend("var decorators = container.decorators;\n"), this.decorators.push("return fn;"), s ? this.decorators = Function.apply(this, ["fn", "props", "container", "depth0", "data", "blockParams", "depths", this.decorators.merge()]) : (this.decorators.prepend("function(fn, props, container, depth0, data, blockParams, depths) {\n"), this.decorators.push("}\n"), this.decorators = this.decorators.merge()));
                    var l = this.createFunctionContext(s);
                    if (this.isChild) return l;
                    var p = {
                        compiler: this.compilerInfo(),
                        main: l
                    };
                    this.decorators && (p.main_d = this.decorators, p.useDecorators = !0);
                    var u = this.context,
                        f = u.programs,
                        d = u.decorators;
                    for (o = 0, c = f.length; c > o; o++) f[o] && (p[o] = f[o], d[o] && (p[o + "_d"] = d[o], p.useDecorators = !0));
                    return this.environment.usePartial && (p.usePartial = !0), this.options.data && (p.useData = !0), this.useDepths && (p.useDepths = !0), this.useBlockParams && (p.useBlockParams = !0), this.options.compat && (p.compat = !0), s ? p.compilerOptions = this.options : (p.compiler = JSON.stringify(p.compiler), this.source.currentLocation = {
                        start: {
                            line: 1,
                            column: 0
                        }
                    }, p = this.objectLiteral(p), e.srcName ? (p = p.toStringWithSourceMap({
                        file: e.destName
                    }), p.map = p.map && p.map.toString()) : p = p.toString()), p
                },
                preamble: function() {
                    this.lastContext = 0, this.source = new u["default"](this.options.srcName), this.decorators = new u["default"](this.options.srcName)
                },
                createFunctionContext: function(t) {
                    var e = "",
                        r = this.stackVars.concat(this.registers.list);
                    r.length > 0 && (e += ", " + r.join(", "));
                    var s = 0;
                    for (var i in this.aliases) {
                        var a = this.aliases[i];
                        this.aliases.hasOwnProperty(i) && a.children && a.referenceCount > 1 && (e += ", alias" + ++s + "=" + i, a.children[0] = "alias" + s)
                    }
                    var n = ["container", "depth0", "helpers", "partials", "data"];
                    (this.useBlockParams || this.useDepths) && n.push("blockParams"), this.useDepths && n.push("depths");
                    var o = this.mergeSource(e);
                    return t ? (n.push(o), Function.apply(this, n)) : this.source.wrap(["function(", n.join(","), ") {\n  ", o, "}"])
                },
                mergeSource: function(t) {
                    var e = this.environment.isSimple,
                        r = !this.forceBuffer,
                        s = void 0,
                        i = void 0,
                        a = void 0,
                        n = void 0;
                    return this.source.each(function(t) {
                        t.appendToBuffer ? (a ? t.prepend("  + ") : a = t, n = t) : (a && (i ? a.prepend("buffer += ") : s = !0, n.add(";"), a = n = void 0), i = !0, e || (r = !1))
                    }), r ? a ? (a.prepend("return "), n.add(";")) : i || this.source.push('return "";') : (t += ", buffer = " + (s ? "" : this.initializeBuffer()), a ? (a.prepend("return buffer + "), n.add(";")) : this.source.push("return buffer;")), t && this.source.prepend("var " + t.substring(2) + (s ? "" : ";\n")), this.source.merge()
                },
                blockValue: function(t) {
                    var e = this.aliasable("helpers.blockHelperMissing"),
                        r = [this.contextName(0)];
                    this.setupHelperArgs(t, 0, r);
                    var s = this.popStack();
                    r.splice(1, 0, s), this.push(this.source.functionCall(e, "call", r))
                },
                ambiguousBlockValue: function() {
                    var t = this.aliasable("helpers.blockHelperMissing"),
                        e = [this.contextName(0)];
                    this.setupHelperArgs("", 0, e, !0), this.flushInline();
                    var r = this.topStack();
                    e.splice(1, 0, r), this.pushSource(["if (!", this.lastHelper, ") { ", r, " = ", this.source.functionCall(t, "call", e), "}"])
                },
                appendContent: function(t) {
                    this.pendingContent ? t = this.pendingContent + t : this.pendingLocation = this.source.currentLocation, this.pendingContent = t
                },
                append: function() {
                    if (this.isInline()) this.replaceStack(function(t) {
                        return [" != null ? ", t, ' : ""']
                    }), this.pushSource(this.appendToBuffer(this.popStack()));
                    else {
                        var t = this.popStack();
                        this.pushSource(["if (", t, " != null) { ", this.appendToBuffer(t, void 0, !0), " }"]), this.environment.isSimple && this.pushSource(["else { ", this.appendToBuffer("''", void 0, !0), " }"])
                    }
                },
                appendEscaped: function() {
                    this.pushSource(this.appendToBuffer([this.aliasable("container.escapeExpression"), "(", this.popStack(), ")"]))
                },
                getContext: function(t) {
                    this.lastContext = t
                },
                pushContext: function() {
                    this.pushStackLiteral(this.contextName(this.lastContext))
                },
                lookupOnContext: function(t, e, r, s) {
                    var i = 0;
                    s || !this.options.compat || this.lastContext ? this.pushContext() : this.push(this.depthedLookup(t[i++])), this.resolvePath("context", t, i, e, r)
                },
                lookupBlockParam: function(t, e) {
                    this.useBlockParams = !0, this.push(["blockParams[", t[0], "][", t[1], "]"]), this.resolvePath("context", e, 1)
                },
                lookupData: function(t, e, r) {
                    t ? this.pushStackLiteral("container.data(data, " + t + ")") : this.pushStackLiteral("data"), this.resolvePath("data", e, 0, !0, r)
                },
                resolvePath: function(t, e, r, s, i) {
                    var n = this;
                    if (this.options.strict || this.options.assumeObjects) return void this.push(a(this.options.strict && i, this, e, t));
                    for (var o = e.length; o > r; r++) this.replaceStack(function(i) {
                        var a = n.nameLookup(i, e[r], t);
                        return s ? [" && ", a] : [" != null ? ", a, " : ", i]
                    })
                },
                resolvePossibleLambda: function() {
                    this.push([this.aliasable("container.lambda"), "(", this.popStack(), ", ", this.contextName(0), ")"])
                },
                pushStringParam: function(t, e) {
                    this.pushContext(), this.pushString(e), "SubExpression" !== e && ("string" == typeof t ? this.pushString(t) : this.pushStackLiteral(t))
                },
                emptyHash: function(t) {
                    this.trackIds && this.push("{}"), this.stringParams && (this.push("{}"), this.push("{}")), this.pushStackLiteral(t ? "undefined" : "{}")
                },
                pushHash: function() {
                    this.hash && this.hashes.push(this.hash), this.hash = {
                        values: [],
                        types: [],
                        contexts: [],
                        ids: []
                    }
                },
                popHash: function() {
                    var t = this.hash;
                    this.hash = this.hashes.pop(), this.trackIds && this.push(this.objectLiteral(t.ids)), this.stringParams && (this.push(this.objectLiteral(t.contexts)), this.push(this.objectLiteral(t.types))), this.push(this.objectLiteral(t.values))
                },
                pushString: function(t) {
                    this.pushStackLiteral(this.quotedString(t))
                },
                pushLiteral: function(t) {
                    this.pushStackLiteral(t)
                },
                pushProgram: function(t) {
                    null != t ? this.pushStackLiteral(this.programExpression(t)) : this.pushStackLiteral(null)
                },
                registerDecorator: function(t, e) {
                    var r = this.nameLookup("decorators", e, "decorator"),
                        s = this.setupHelperArgs(e, t);
                    this.decorators.push(["fn = ", this.decorators.functionCall(r, "", ["fn", "props", "container", s]), " || fn;"])
                },
                invokeHelper: function(t, e, r) {
                    var s = this.popStack(),
                        i = this.setupHelper(t, e),
                        a = r ? [i.name, " || "] : "",
                        n = ["("].concat(a, s);
                    this.options.strict || n.push(" || ", this.aliasable("helpers.helperMissing")), n.push(")"), this.push(this.source.functionCall(n, "call", i.callParams))
                },
                invokeKnownHelper: function(t, e) {
                    var r = this.setupHelper(t, e);
                    this.push(this.source.functionCall(r.name, "call", r.callParams))
                },
                invokeAmbiguous: function(t, e) {
                    this.useRegister("helper");
                    var r = this.popStack();
                    this.emptyHash();
                    var s = this.setupHelper(0, t, e),
                        i = this.lastHelper = this.nameLookup("helpers", t, "helper"),
                        a = ["(", "(helper = ", i, " || ", r, ")"];
                    this.options.strict || (a[0] = "(helper = ", a.push(" != null ? helper : ", this.aliasable("helpers.helperMissing"))), this.push(["(", a, s.paramsInit ? ["),(", s.paramsInit] : [], "),", "(typeof helper === ", this.aliasable('"function"'), " ? ", this.source.functionCall("helper", "call", s.callParams), " : helper))"])
                },
                invokePartial: function(t, e, r) {
                    var s = [],
                        i = this.setupParams(e, 1, s);
                    t && (e = this.popStack(), delete i.name), r && (i.indent = JSON.stringify(r)), i.helpers = "helpers", i.partials = "partials", i.decorators = "container.decorators", t ? s.unshift(e) : s.unshift(this.nameLookup("partials", e, "partial")), this.options.compat && (i.depths = "depths"), i = this.objectLiteral(i), s.push(i), this.push(this.source.functionCall("container.invokePartial", "", s))
                },
                assignToHash: function(t) {
                    var e = this.popStack(),
                        r = void 0,
                        s = void 0,
                        i = void 0;
                    this.trackIds && (i = this.popStack()), this.stringParams && (s = this.popStack(), r = this.popStack());
                    var a = this.hash;
                    r && (a.contexts[t] = r), s && (a.types[t] = s), i && (a.ids[t] = i), a.values[t] = e
                },
                pushId: function(t, e, r) {
                    "BlockParam" === t ? this.pushStackLiteral("blockParams[" + e[0] + "].path[" + e[1] + "]" + (r ? " + " + JSON.stringify("." + r) : "")) : "PathExpression" === t ? this.pushString(e) : "SubExpression" === t ? this.pushStackLiteral("true") : this.pushStackLiteral("null")
                },
                compiler: i,
                compileChildren: function(t, e) {
                    for (var r = t.children, s = void 0, i = void 0, a = 0, n = r.length; n > a; a++) {
                        s = r[a], i = new this.compiler;
                        var o = this.matchExistingProgram(s);
                        null == o ? (this.context.programs.push(""), o = this.context.programs.length, s.index = o, s.name = "program" + o, this.context.programs[o] = i.compile(s, e, this.context, !this.precompile), this.context.decorators[o] = i.decorators, this.context.environments[o] = s, this.useDepths = this.useDepths || i.useDepths, this.useBlockParams = this.useBlockParams || i.useBlockParams) : (s.index = o, s.name = "program" + o, this.useDepths = this.useDepths || s.useDepths, this.useBlockParams = this.useBlockParams || s.useBlockParams)
                    }
                },
                matchExistingProgram: function(t) {
                    for (var e = 0, r = this.context.environments.length; r > e; e++) {
                        var s = this.context.environments[e];
                        if (s && s.equals(t)) return e
                    }
                },
                programExpression: function(t) {
                    var e = this.environment.children[t],
                        r = [e.index, "data", e.blockParams];
                    return (this.useBlockParams || this.useDepths) && r.push("blockParams"), this.useDepths && r.push("depths"), "container.program(" + r.join(", ") + ")"
                },
                useRegister: function(t) {
                    this.registers[t] || (this.registers[t] = !0, this.registers.list.push(t))
                },
                push: function(t) {
                    return t instanceof s || (t = this.source.wrap(t)), this.inlineStack.push(t), t
                },
                pushStackLiteral: function(t) {
                    this.push(new s(t))
                },
                pushSource: function(t) {
                    this.pendingContent && (this.source.push(this.appendToBuffer(this.source.quotedString(this.pendingContent), this.pendingLocation)), this.pendingContent = void 0), t && this.source.push(t)
                },
                replaceStack: function(t) {
                    var e = ["("],
                        r = void 0,
                        i = void 0,
                        a = void 0;
                    if (!this.isInline()) throw new h["default"]("replaceStack on non-inline");
                    var n = this.popStack(!0);
                    if (n instanceof s) r = [n.value], e = ["(", r], a = !0;
                    else {
                        i = !0;
                        var o = this.incrStack();
                        e = ["((", this.push(o), " = ", n, ")"], r = this.topStack()
                    }
                    var c = t.call(this, r);
                    a || this.popStack(), i && this.stackSlot--, this.push(e.concat(c, ")"))
                },
                incrStack: function() {
                    return this.stackSlot++, this.stackSlot > this.stackVars.length && this.stackVars.push("stack" + this.stackSlot), this.topStackName()
                },
                topStackName: function() {
                    return "stack" + this.stackSlot
                },
                flushInline: function() {
                    var t = this.inlineStack;
                    this.inlineStack = [];
                    for (var e = 0, r = t.length; r > e; e++) {
                        var i = t[e];
                        if (i instanceof s) this.compileStack.push(i);
                        else {
                            var a = this.incrStack();
                            this.pushSource([a, " = ", i, ";"]), this.compileStack.push(a)
                        }
                    }
                },
                isInline: function() {
                    return this.inlineStack.length
                },
                popStack: function(t) {
                    var e = this.isInline(),
                        r = (e ? this.inlineStack : this.compileStack).pop();
                    if (!t && r instanceof s) return r.value;
                    if (!e) {
                        if (!this.stackSlot) throw new h["default"]("Invalid stack pop");
                        this.stackSlot--
                    }
                    return r
                },
                topStack: function() {
                    var t = this.isInline() ? this.inlineStack : this.compileStack,
                        e = t[t.length - 1];
                    return e instanceof s ? e.value : e
                },
                contextName: function(t) {
                    return this.useDepths && t ? "depths[" + t + "]" : "depth" + t
                },
                quotedString: function(t) {
                    return this.source.quotedString(t)
                },
                objectLiteral: function(t) {
                    return this.source.objectLiteral(t)
                },
                aliasable: function(t) {
                    var e = this.aliases[t];
                    return e ? (e.referenceCount++, e) : (e = this.aliases[t] = this.source.wrap(t), e.aliasable = !0, e.referenceCount = 1, e)
                },
                setupHelper: function(t, e, r) {
                    var s = [],
                        i = this.setupHelperArgs(e, t, s, r),
                        a = this.nameLookup("helpers", e, "helper"),
                        n = this.aliasable(this.contextName(0) + " != null ? " + this.contextName(0) + " : {}");
                    return {
                        params: s,
                        paramsInit: i,
                        name: a,
                        callParams: [n].concat(s)
                    }
                },
                setupParams: function(t, e, r) {
                    var s = {},
                        i = [],
                        a = [],
                        n = [],
                        o = !r,
                        c = void 0;
                    o && (r = []), s.name = this.quotedString(t), s.hash = this.popStack(), this.trackIds && (s.hashIds = this.popStack()), this.stringParams && (s.hashTypes = this.popStack(), s.hashContexts = this.popStack());
                    var h = this.popStack(),
                        l = this.popStack();
                    (l || h) && (s.fn = l || "container.noop", s.inverse = h || "container.noop");
                    for (var p = e; p--;) c = this.popStack(), r[p] = c, this.trackIds && (n[p] = this.popStack()), this.stringParams && (a[p] = this.popStack(), i[p] = this.popStack());
                    return o && (s.args = this.source.generateArray(r)), this.trackIds && (s.ids = this.source.generateArray(n)), this.stringParams && (s.types = this.source.generateArray(a), s.contexts = this.source.generateArray(i)), this.options.data && (s.data = "data"), this.useBlockParams && (s.blockParams = "blockParams"), s
                },
                setupHelperArgs: function(t, e, r, s) {
                    var i = this.setupParams(t, e, r);
                    return i = this.objectLiteral(i), s ? (this.useRegister("options"), r.push("options"), ["options=", i]) : r ? (r.push(i), "") : i
                }
            },
            function() {
                for (var t = "break else new var case finally return void catch for switch while continue function this with default if throw delete in try do instanceof typeof abstract enum int short boolean export interface static byte extends long super char final native synchronized class float package throws const goto private transient debugger implements protected volatile double import public let yield await null true false".split(" "), e = i.RESERVED_WORDS = {}, r = 0, s = t.length; s > r; r++) e[t[r]] = !0
            }(), i.isValidJavaScriptVariableName = function(t) {
                return !i.RESERVED_WORDS[t] && /^[a-zA-Z_$][0-9a-zA-Z_$]*$/.test(t)
            }, e["default"] = i, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";

        function s() {
            this.parents = []
        }

        function i(t) {
            this.acceptRequired(t, "path"), this.acceptArray(t.params), this.acceptKey(t, "hash")
        }

        function a(t) {
            i.call(this, t), this.acceptKey(t, "program"), this.acceptKey(t, "inverse")
        }

        function n(t) {
            this.acceptRequired(t, "name"), this.acceptArray(t.params), this.acceptKey(t, "hash")
        }
        var o = r(8)["default"];
        e.__esModule = !0;
        var c = r(12),
            h = o(c);
        s.prototype = {
            constructor: s,
            mutating: !1,
            acceptKey: function(t, e) {
                var r = this.accept(t[e]);
                if (this.mutating) {
                    if (r && !s.prototype[r.type]) throw new h["default"]('Unexpected node type "' + r.type + '" found when accepting ' + e + " on " + t.type);
                    t[e] = r
                }
            },
            acceptRequired: function(t, e) {
                if (this.acceptKey(t, e), !t[e]) throw new h["default"](t.type + " requires " + e)
            },
            acceptArray: function(t) {
                for (var e = 0, r = t.length; r > e; e++) this.acceptKey(t, e), t[e] || (t.splice(e, 1), e--, r--)
            },
            accept: function(t) {
                if (t) {
                    if (!this[t.type]) throw new h["default"]("Unknown type: " + t.type, t);
                    this.current && this.parents.unshift(this.current), this.current = t;
                    var e = this[t.type](t);
                    return this.current = this.parents.shift(), !this.mutating || e ? e : e !== !1 ? t : void 0
                }
            },
            Program: function(t) {
                this.acceptArray(t.body)
            },
            MustacheStatement: i,
            Decorator: i,
            BlockStatement: a,
            DecoratorBlock: a,
            PartialStatement: n,
            PartialBlockStatement: function(t) {
                n.call(this, t), this.acceptKey(t, "program")
            },
            ContentStatement: function() {},
            CommentStatement: function() {},
            SubExpression: i,
            PathExpression: function() {},
            StringLiteral: function() {},
            NumberLiteral: function() {},
            BooleanLiteral: function() {},
            UndefinedLiteral: function() {},
            NullLiteral: function() {},
            Hash: function(t) {
                this.acceptArray(t.pairs)
            },
            HashPair: function(t) {
                this.acceptRequired(t, "value")
            }
        }, e["default"] = s, t.exports = e["default"]
    }, function(t, e) {
        (function(r) {
            "use strict";
            e.__esModule = !0, e["default"] = function(t) {
                var e = "undefined" != typeof r ? r : window,
                    s = e.Handlebars;
                t.noConflict = function() {
                    e.Handlebars === t && (e.Handlebars = s)
                }
            }, t.exports = e["default"]
        }).call(e, function() {
            return this
        }())
    }, function(t, e) {
        "use strict";
        e["default"] = function(t) {
            return t && t.__esModule ? t : {
                "default": t
            }
        }, e.__esModule = !0
    }, function(t, e) {
        "use strict";
        e["default"] = function(t) {
            if (t && t.__esModule) return t;
            var e = {};
            if (null != t)
                for (var r in t) Object.prototype.hasOwnProperty.call(t, r) && (e[r] = t[r]);
            return e["default"] = t, e
        }, e.__esModule = !0
    }, function(t, e, r) {
        "use strict";

        function s(t, e, r) {
            this.helpers = t || {}, this.partials = e || {}, this.decorators = r || {}, c.registerDefaultHelpers(this), h.registerDefaultDecorators(this)
        }
        var i = r(8)["default"];
        e.__esModule = !0, e.HandlebarsEnvironment = s;
        var a = r(13),
            n = r(12),
            o = i(n),
            c = r(19),
            h = r(20),
            l = r(21),
            p = i(l),
            u = "4.0.3";
        e.VERSION = u;
        var f = 7;
        e.COMPILER_REVISION = f;
        var d = {
            1: "<= 1.0.rc.2",
            2: "== 1.0.0-rc.3",
            3: "== 1.0.0-rc.4",
            4: "== 1.x.x",
            5: "== 2.0.0-alpha.x",
            6: ">= 2.0.0-beta.1",
            7: ">= 4.0.0"
        };
        e.REVISION_CHANGES = d;
        var m = "[object Object]";
        s.prototype = {
            constructor: s,
            logger: p["default"],
            log: p["default"].log,
            registerHelper: function(t, e) {
                if (a.toString.call(t) === m) {
                    if (e) throw new o["default"]("Arg not supported with multiple helpers");
                    a.extend(this.helpers, t)
                } else this.helpers[t] = e
            },
            unregisterHelper: function(t) {
                delete this.helpers[t]
            },
            registerPartial: function(t, e) {
                if (a.toString.call(t) === m) a.extend(this.partials, t);
                else {
                    if ("undefined" == typeof e) throw new o["default"]("Attempting to register a partial as undefined");
                    this.partials[t] = e
                }
            },
            unregisterPartial: function(t) {
                delete this.partials[t]
            },
            registerDecorator: function(t, e) {
                if (a.toString.call(t) === m) {
                    if (e) throw new o["default"]("Arg not supported with multiple decorators");
                    a.extend(this.decorators, t)
                } else this.decorators[t] = e
            },
            unregisterDecorator: function(t) {
                delete this.decorators[t]
            }
        };
        var g = p["default"].log;
        e.log = g, e.createFrame = a.createFrame, e.logger = p["default"]
    }, function(t, e) {
        "use strict";

        function r(t) {
            this.string = t
        }
        e.__esModule = !0, r.prototype.toString = r.prototype.toHTML = function() {
            return "" + this.string
        }, e["default"] = r, t.exports = e["default"]
    }, function(t, e) {
        "use strict";

        function r(t, e) {
            var i = e && e.loc,
                a = void 0,
                n = void 0;
            i && (a = i.start.line, n = i.start.column, t += " - " + a + ":" + n);
            for (var o = Error.prototype.constructor.call(this, t), c = 0; c < s.length; c++) this[s[c]] = o[s[c]];
            Error.captureStackTrace && Error.captureStackTrace(this, r), i && (this.lineNumber = a, this.column = n)
        }
        e.__esModule = !0;
        var s = ["description", "fileName", "lineNumber", "message", "name", "number", "stack"];
        r.prototype = new Error, e["default"] = r, t.exports = e["default"]
    }, function(t, e) {
        "use strict";

        function r(t) {
            return l[t]
        }

        function s(t) {
            for (var e = 1; e < arguments.length; e++)
                for (var r in arguments[e]) Object.prototype.hasOwnProperty.call(arguments[e], r) && (t[r] = arguments[e][r]);
            return t
        }

        function i(t, e) {
            for (var r = 0, s = t.length; s > r; r++)
                if (t[r] === e) return r;
            return -1
        }

        function a(t) {
            if ("string" != typeof t) {
                if (t && t.toHTML) return t.toHTML();
                if (null == t) return "";
                if (!t) return t + "";
                t = "" + t
            }
            return u.test(t) ? t.replace(p, r) : t
        }

        function n(t) {
            return t || 0 === t ? m(t) && 0 === t.length ? !0 : !1 : !0
        }

        function o(t) {
            var e = s({}, t);
            return e._parent = t, e
        }

        function c(t, e) {
            return t.path = e, t
        }

        function h(t, e) {
            return (t ? t + "." : "") + e
        }
        e.__esModule = !0, e.extend = s, e.indexOf = i, e.escapeExpression = a, e.isEmpty = n, e.createFrame = o, e.blockParams = c, e.appendContextPath = h;
        var l = {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;",
                "`": "&#x60;",
                "=": "&#x3D;"
            },
            p = /[&<>"'`=]/g,
            u = /[&<>"'`=]/,
            f = Object.prototype.toString;
        e.toString = f;
        var d = function(t) {
            return "function" == typeof t
        };
        d(/x/) && (e.isFunction = d = function(t) {
            return "function" == typeof t && "[object Function]" === f.call(t)
        }), e.isFunction = d;
        var m = Array.isArray || function(t) {
            return t && "object" == typeof t ? "[object Array]" === f.call(t) : !1
        };
        e.isArray = m
    }, function(t, e, r) {
        "use strict";

        function s(t) {
            var e = t && t[0] || 1,
                r = v.COMPILER_REVISION;
            if (e !== r) {
                if (r > e) {
                    var s = v.REVISION_CHANGES[r],
                        i = v.REVISION_CHANGES[e];
                    throw new g["default"]("Template was precompiled with an older version of Handlebars than the current runtime. Please update your precompiler to a newer version (" + s + ") or downgrade your runtime to an older version (" + i + ").")
                }
                throw new g["default"]("Template was precompiled with a newer version of Handlebars than the current runtime. Please update your runtime to a newer version (" + t[1] + ").")
            }
        }

        function i(t, e) {
            function r(r, s, i) {
                i.hash && (s = d.extend({}, s, i.hash), i.ids && (i.ids[0] = !0)), r = e.VM.resolvePartial.call(this, r, s, i);
                var a = e.VM.invokePartial.call(this, r, s, i);
                if (null == a && e.compile && (i.partials[i.name] = e.compile(r, t.compilerOptions, e), a = i.partials[i.name](s, i)), null != a) {
                    if (i.indent) {
                        for (var n = a.split("\n"), o = 0, c = n.length; c > o && (n[o] || o + 1 !== c); o++) n[o] = i.indent + n[o];
                        a = n.join("\n")
                    }
                    return a
                }
                throw new g["default"]("The partial " + i.name + " could not be compiled when running in runtime-only mode")
            }

            function s(e) {
                function r(e) {
                    return "" + t.main(i, e, i.helpers, i.partials, n, c, o)
                }
                var a = arguments.length <= 1 || void 0 === arguments[1] ? {} : arguments[1],
                    n = a.data;
                s._setup(a), !a.partial && t.useData && (n = h(e, n));
                var o = void 0,
                    c = t.useBlockParams ? [] : void 0;
                return t.useDepths && (o = a.depths ? e !== a.depths[0] ? [e].concat(a.depths) : a.depths : [e]), (r = l(t.main, r, i, a.depths || [], n, c))(e, a)
            }
            if (!e) throw new g["default"]("No environment passed to template");
            if (!t || !t.main) throw new g["default"]("Unknown template object: " + typeof t);
            t.main.decorator = t.main_d, e.VM.checkRevision(t.compiler);
            var i = {
                strict: function(t, e) {
                    if (!(e in t)) throw new g["default"]('"' + e + '" not defined in ' + t);
                    return t[e]
                },
                lookup: function(t, e) {
                    for (var r = t.length, s = 0; r > s; s++)
                        if (t[s] && null != t[s][e]) return t[s][e]
                },
                lambda: function(t, e) {
                    return "function" == typeof t ? t.call(e) : t
                },
                escapeExpression: d.escapeExpression,
                invokePartial: r,
                fn: function(e) {
                    var r = t[e];
                    return r.decorator = t[e + "_d"], r
                },
                programs: [],
                program: function(t, e, r, s, i) {
                    var n = this.programs[t],
                        o = this.fn(t);
                    return e || i || s || r ? n = a(this, t, o, e, r, s, i) : n || (n = this.programs[t] = a(this, t, o)), n
                },
                data: function(t, e) {
                    for (; t && e--;) t = t._parent;
                    return t
                },
                merge: function(t, e) {
                    var r = t || e;
                    return t && e && t !== e && (r = d.extend({}, e, t)), r
                },
                noop: e.VM.noop,
                compilerInfo: t.compiler
            };
            return s.isTop = !0, s._setup = function(r) {
                r.partial ? (i.helpers = r.helpers, i.partials = r.partials, i.decorators = r.decorators) : (i.helpers = i.merge(r.helpers, e.helpers), t.usePartial && (i.partials = i.merge(r.partials, e.partials)), (t.usePartial || t.useDecorators) && (i.decorators = i.merge(r.decorators, e.decorators)))
            }, s._child = function(e, r, s, n) {
                if (t.useBlockParams && !s) throw new g["default"]("must pass block params");
                if (t.useDepths && !n) throw new g["default"]("must pass parent depths");
                return a(i, e, t[e], r, 0, s, n)
            }, s
        }

        function a(t, e, r, s, i, a, n) {
            function o(e) {
                var i = arguments.length <= 1 || void 0 === arguments[1] ? {} : arguments[1],
                    o = n;
                return n && e !== n[0] && (o = [e].concat(n)), r(t, e, t.helpers, t.partials, i.data || s, a && [i.blockParams].concat(a), o)
            }
            return o = l(r, o, t, n, s, a), o.program = e, o.depth = n ? n.length : 0, o.blockParams = i || 0, o
        }

        function n(t, e, r) {
            return t ? t.call || r.name || (r.name = t, t = r.partials[t]) : t = "@partial-block" === r.name ? r.data["partial-block"] : r.partials[r.name], t
        }

        function o(t, e, r) {
            r.partial = !0, r.ids && (r.data.contextPath = r.ids[0] || r.data.contextPath);
            var s = void 0;
            if (r.fn && r.fn !== c && (r.data = v.createFrame(r.data), s = r.data["partial-block"] = r.fn, s.partials && (r.partials = d.extend({}, r.partials, s.partials))), void 0 === t && s && (t = s), void 0 === t) throw new g["default"]("The partial " + r.name + " could not be found");
            return t instanceof Function ? t(e, r) : void 0
        }

        function c() {
            return ""
        }

        function h(t, e) {
            return e && "root" in e || (e = e ? v.createFrame(e) : {}, e.root = t), e
        }

        function l(t, e, r, s, i, a) {
            if (t.decorator) {
                var n = {};
                e = t.decorator(e, n, r, s && s[0], i, a, s), d.extend(e, n)
            }
            return e
        }
        var p = r(9)["default"],
            u = r(8)["default"];
        e.__esModule = !0, e.checkRevision = s, e.template = i, e.wrapProgram = a, e.resolvePartial = n, e.invokePartial = o, e.noop = c;
        var f = r(13),
            d = p(f),
            m = r(12),
            g = u(m),
            v = r(10)
    }, function(t, e) {
        "use strict";
        var r = function() {
            function t() {
                this.yy = {}
            }
            var e = {
                    trace: function() {},
                    yy: {},
                    symbols_: {
                        error: 2,
                        root: 3,
                        program: 4,
                        EOF: 5,
                        program_repetition0: 6,
                        statement: 7,
                        mustache: 8,
                        block: 9,
                        rawBlock: 10,
                        partial: 11,
                        partialBlock: 12,
                        content: 13,
                        COMMENT: 14,
                        CONTENT: 15,
                        openRawBlock: 16,
                        rawBlock_repetition_plus0: 17,
                        END_RAW_BLOCK: 18,
                        OPEN_RAW_BLOCK: 19,
                        helperName: 20,
                        openRawBlock_repetition0: 21,
                        openRawBlock_option0: 22,
                        CLOSE_RAW_BLOCK: 23,
                        openBlock: 24,
                        block_option0: 25,
                        closeBlock: 26,
                        openInverse: 27,
                        block_option1: 28,
                        OPEN_BLOCK: 29,
                        openBlock_repetition0: 30,
                        openBlock_option0: 31,
                        openBlock_option1: 32,
                        CLOSE: 33,
                        OPEN_INVERSE: 34,
                        openInverse_repetition0: 35,
                        openInverse_option0: 36,
                        openInverse_option1: 37,
                        openInverseChain: 38,
                        OPEN_INVERSE_CHAIN: 39,
                        openInverseChain_repetition0: 40,
                        openInverseChain_option0: 41,
                        openInverseChain_option1: 42,
                        inverseAndProgram: 43,
                        INVERSE: 44,
                        inverseChain: 45,
                        inverseChain_option0: 46,
                        OPEN_ENDBLOCK: 47,
                        OPEN: 48,
                        mustache_repetition0: 49,
                        mustache_option0: 50,
                        OPEN_UNESCAPED: 51,
                        mustache_repetition1: 52,
                        mustache_option1: 53,
                        CLOSE_UNESCAPED: 54,
                        OPEN_PARTIAL: 55,
                        partialName: 56,
                        partial_repetition0: 57,
                        partial_option0: 58,
                        openPartialBlock: 59,
                        OPEN_PARTIAL_BLOCK: 60,
                        openPartialBlock_repetition0: 61,
                        openPartialBlock_option0: 62,
                        param: 63,
                        sexpr: 64,
                        OPEN_SEXPR: 65,
                        sexpr_repetition0: 66,
                        sexpr_option0: 67,
                        CLOSE_SEXPR: 68,
                        hash: 69,
                        hash_repetition_plus0: 70,
                        hashSegment: 71,
                        ID: 72,
                        EQUALS: 73,
                        blockParams: 74,
                        OPEN_BLOCK_PARAMS: 75,
                        blockParams_repetition_plus0: 76,
                        CLOSE_BLOCK_PARAMS: 77,
                        path: 78,
                        dataName: 79,
                        STRING: 80,
                        NUMBER: 81,
                        BOOLEAN: 82,
                        UNDEFINED: 83,
                        NULL: 84,
                        DATA: 85,
                        pathSegments: 86,
                        SEP: 87,
                        $accept: 0,
                        $end: 1
                    },
                    terminals_: {
                        2: "error",
                        5: "EOF",
                        14: "COMMENT",
                        15: "CONTENT",
                        18: "END_RAW_BLOCK",
                        19: "OPEN_RAW_BLOCK",
                        23: "CLOSE_RAW_BLOCK",
                        29: "OPEN_BLOCK",
                        33: "CLOSE",
                        34: "OPEN_INVERSE",
                        39: "OPEN_INVERSE_CHAIN",
                        44: "INVERSE",
                        47: "OPEN_ENDBLOCK",
                        48: "OPEN",
                        51: "OPEN_UNESCAPED",
                        54: "CLOSE_UNESCAPED",
                        55: "OPEN_PARTIAL",
                        60: "OPEN_PARTIAL_BLOCK",
                        65: "OPEN_SEXPR",
                        68: "CLOSE_SEXPR",
                        72: "ID",
                        73: "EQUALS",
                        75: "OPEN_BLOCK_PARAMS",
                        77: "CLOSE_BLOCK_PARAMS",
                        80: "STRING",
                        81: "NUMBER",
                        82: "BOOLEAN",
                        83: "UNDEFINED",
                        84: "NULL",
                        85: "DATA",
                        87: "SEP"
                    },
                    productions_: [0, [3, 2],
                        [4, 1],
                        [7, 1],
                        [7, 1],
                        [7, 1],
                        [7, 1],
                        [7, 1],
                        [7, 1],
                        [7, 1],
                        [13, 1],
                        [10, 3],
                        [16, 5],
                        [9, 4],
                        [9, 4],
                        [24, 6],
                        [27, 6],
                        [38, 6],
                        [43, 2],
                        [45, 3],
                        [45, 1],
                        [26, 3],
                        [8, 5],
                        [8, 5],
                        [11, 5],
                        [12, 3],
                        [59, 5],
                        [63, 1],
                        [63, 1],
                        [64, 5],
                        [69, 1],
                        [71, 3],
                        [74, 3],
                        [20, 1],
                        [20, 1],
                        [20, 1],
                        [20, 1],
                        [20, 1],
                        [20, 1],
                        [20, 1],
                        [56, 1],
                        [56, 1],
                        [79, 2],
                        [78, 1],
                        [86, 3],
                        [86, 1],
                        [6, 0],
                        [6, 2],
                        [17, 1],
                        [17, 2],
                        [21, 0],
                        [21, 2],
                        [22, 0],
                        [22, 1],
                        [25, 0],
                        [25, 1],
                        [28, 0],
                        [28, 1],
                        [30, 0],
                        [30, 2],
                        [31, 0],
                        [31, 1],
                        [32, 0],
                        [32, 1],
                        [35, 0],
                        [35, 2],
                        [36, 0],
                        [36, 1],
                        [37, 0],
                        [37, 1],
                        [40, 0],
                        [40, 2],
                        [41, 0],
                        [41, 1],
                        [42, 0],
                        [42, 1],
                        [46, 0],
                        [46, 1],
                        [49, 0],
                        [49, 2],
                        [50, 0],
                        [50, 1],
                        [52, 0],
                        [52, 2],
                        [53, 0],
                        [53, 1],
                        [57, 0],
                        [57, 2],
                        [58, 0],
                        [58, 1],
                        [61, 0],
                        [61, 2],
                        [62, 0],
                        [62, 1],
                        [66, 0],
                        [66, 2],
                        [67, 0],
                        [67, 1],
                        [70, 1],
                        [70, 2],
                        [76, 1],
                        [76, 2]
                    ],
                    performAction: function(t, e, r, s, i, a) {
                        var n = a.length - 1;
                        switch (i) {
                            case 1:
                                return a[n - 1];
                            case 2:
                                this.$ = s.prepareProgram(a[n]);
                                break;
                            case 3:
                                this.$ = a[n];
                                break;
                            case 4:
                                this.$ = a[n];
                                break;
                            case 5:
                                this.$ = a[n];
                                break;
                            case 6:
                                this.$ = a[n];
                                break;
                            case 7:
                                this.$ = a[n];
                                break;
                            case 8:
                                this.$ = a[n];
                                break;
                            case 9:
                                this.$ = {
                                    type: "CommentStatement",
                                    value: s.stripComment(a[n]),
                                    strip: s.stripFlags(a[n], a[n]),
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 10:
                                this.$ = {
                                    type: "ContentStatement",
                                    original: a[n],
                                    value: a[n],
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 11:
                                this.$ = s.prepareRawBlock(a[n - 2], a[n - 1], a[n], this._$);
                                break;
                            case 12:
                                this.$ = {
                                    path: a[n - 3],
                                    params: a[n - 2],
                                    hash: a[n - 1]
                                };
                                break;
                            case 13:
                                this.$ = s.prepareBlock(a[n - 3], a[n - 2], a[n - 1], a[n], !1, this._$);
                                break;
                            case 14:
                                this.$ = s.prepareBlock(a[n - 3], a[n - 2], a[n - 1], a[n], !0, this._$);
                                break;
                            case 15:
                                this.$ = {
                                    open: a[n - 5],
                                    path: a[n - 4],
                                    params: a[n - 3],
                                    hash: a[n - 2],
                                    blockParams: a[n - 1],
                                    strip: s.stripFlags(a[n - 5], a[n])
                                };
                                break;
                            case 16:
                                this.$ = {
                                    path: a[n - 4],
                                    params: a[n - 3],
                                    hash: a[n - 2],
                                    blockParams: a[n - 1],
                                    strip: s.stripFlags(a[n - 5], a[n])
                                };
                                break;
                            case 17:
                                this.$ = {
                                    path: a[n - 4],
                                    params: a[n - 3],
                                    hash: a[n - 2],
                                    blockParams: a[n - 1],
                                    strip: s.stripFlags(a[n - 5], a[n])
                                };
                                break;
                            case 18:
                                this.$ = {
                                    strip: s.stripFlags(a[n - 1], a[n - 1]),
                                    program: a[n]
                                };
                                break;
                            case 19:
                                var o = s.prepareBlock(a[n - 2], a[n - 1], a[n], a[n], !1, this._$),
                                    c = s.prepareProgram([o], a[n - 1].loc);
                                c.chained = !0, this.$ = {
                                    strip: a[n - 2].strip,
                                    program: c,
                                    chain: !0
                                };
                                break;
                            case 20:
                                this.$ = a[n];
                                break;
                            case 21:
                                this.$ = {
                                    path: a[n - 1],
                                    strip: s.stripFlags(a[n - 2], a[n])
                                };
                                break;
                            case 22:
                                this.$ = s.prepareMustache(a[n - 3], a[n - 2], a[n - 1], a[n - 4], s.stripFlags(a[n - 4], a[n]), this._$);
                                break;
                            case 23:
                                this.$ = s.prepareMustache(a[n - 3], a[n - 2], a[n - 1], a[n - 4], s.stripFlags(a[n - 4], a[n]), this._$);
                                break;
                            case 24:
                                this.$ = {
                                    type: "PartialStatement",
                                    name: a[n - 3],
                                    params: a[n - 2],
                                    hash: a[n - 1],
                                    indent: "",
                                    strip: s.stripFlags(a[n - 4], a[n]),
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 25:
                                this.$ = s.preparePartialBlock(a[n - 2], a[n - 1], a[n], this._$);
                                break;
                            case 26:
                                this.$ = {
                                    path: a[n - 3],
                                    params: a[n - 2],
                                    hash: a[n - 1],
                                    strip: s.stripFlags(a[n - 4], a[n])
                                };
                                break;
                            case 27:
                                this.$ = a[n];
                                break;
                            case 28:
                                this.$ = a[n];
                                break;
                            case 29:
                                this.$ = {
                                    type: "SubExpression",
                                    path: a[n - 3],
                                    params: a[n - 2],
                                    hash: a[n - 1],
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 30:
                                this.$ = {
                                    type: "Hash",
                                    pairs: a[n],
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 31:
                                this.$ = {
                                    type: "HashPair",
                                    key: s.id(a[n - 2]),
                                    value: a[n],
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 32:
                                this.$ = s.id(a[n - 1]);
                                break;
                            case 33:
                                this.$ = a[n];
                                break;
                            case 34:
                                this.$ = a[n];
                                break;
                            case 35:
                                this.$ = {
                                    type: "StringLiteral",
                                    value: a[n],
                                    original: a[n],
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 36:
                                this.$ = {
                                    type: "NumberLiteral",
                                    value: Number(a[n]),
                                    original: Number(a[n]),
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 37:
                                this.$ = {
                                    type: "BooleanLiteral",
                                    value: "true" === a[n],
                                    original: "true" === a[n],
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 38:
                                this.$ = {
                                    type: "UndefinedLiteral",
                                    original: void 0,
                                    value: void 0,
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 39:
                                this.$ = {
                                    type: "NullLiteral",
                                    original: null,
                                    value: null,
                                    loc: s.locInfo(this._$)
                                };
                                break;
                            case 40:
                                this.$ = a[n];
                                break;
                            case 41:
                                this.$ = a[n];
                                break;
                            case 42:
                                this.$ = s.preparePath(!0, a[n], this._$);
                                break;
                            case 43:
                                this.$ = s.preparePath(!1, a[n], this._$);
                                break;
                            case 44:
                                a[n - 2].push({
                                    part: s.id(a[n]),
                                    original: a[n],
                                    separator: a[n - 1]
                                }), this.$ = a[n - 2];
                                break;
                            case 45:
                                this.$ = [{
                                    part: s.id(a[n]),
                                    original: a[n]
                                }];
                                break;
                            case 46:
                                this.$ = [];
                                break;
                            case 47:
                                a[n - 1].push(a[n]);
                                break;
                            case 48:
                                this.$ = [a[n]];
                                break;
                            case 49:
                                a[n - 1].push(a[n]);
                                break;
                            case 50:
                                this.$ = [];
                                break;
                            case 51:
                                a[n - 1].push(a[n]);
                                break;
                            case 58:
                                this.$ = [];
                                break;
                            case 59:
                                a[n - 1].push(a[n]);
                                break;
                            case 64:
                                this.$ = [];
                                break;
                            case 65:
                                a[n - 1].push(a[n]);
                                break;
                            case 70:
                                this.$ = [];
                                break;
                            case 71:
                                a[n - 1].push(a[n]);
                                break;
                            case 78:
                                this.$ = [];
                                break;
                            case 79:
                                a[n - 1].push(a[n]);
                                break;
                            case 82:
                                this.$ = [];
                                break;
                            case 83:
                                a[n - 1].push(a[n]);
                                break;
                            case 86:
                                this.$ = [];
                                break;
                            case 87:
                                a[n - 1].push(a[n]);
                                break;
                            case 90:
                                this.$ = [];
                                break;
                            case 91:
                                a[n - 1].push(a[n]);
                                break;
                            case 94:
                                this.$ = [];
                                break;
                            case 95:
                                a[n - 1].push(a[n]);
                                break;
                            case 98:
                                this.$ = [a[n]];
                                break;
                            case 99:
                                a[n - 1].push(a[n]);
                                break;
                            case 100:
                                this.$ = [a[n]];
                                break;
                            case 101:
                                a[n - 1].push(a[n])
                        }
                    },
                    table: [{
                        3: 1,
                        4: 2,
                        5: [2, 46],
                        6: 3,
                        14: [2, 46],
                        15: [2, 46],
                        19: [2, 46],
                        29: [2, 46],
                        34: [2, 46],
                        48: [2, 46],
                        51: [2, 46],
                        55: [2, 46],
                        60: [2, 46]
                    }, {
                        1: [3]
                    }, {
                        5: [1, 4]
                    }, {
                        5: [2, 2],
                        7: 5,
                        8: 6,
                        9: 7,
                        10: 8,
                        11: 9,
                        12: 10,
                        13: 11,
                        14: [1, 12],
                        15: [1, 20],
                        16: 17,
                        19: [1, 23],
                        24: 15,
                        27: 16,
                        29: [1, 21],
                        34: [1, 22],
                        39: [2, 2],
                        44: [2, 2],
                        47: [2, 2],
                        48: [1, 13],
                        51: [1, 14],
                        55: [1, 18],
                        59: 19,
                        60: [1, 24]
                    }, {
                        1: [2, 1]
                    }, {
                        5: [2, 47],
                        14: [2, 47],
                        15: [2, 47],
                        19: [2, 47],
                        29: [2, 47],
                        34: [2, 47],
                        39: [2, 47],
                        44: [2, 47],
                        47: [2, 47],
                        48: [2, 47],
                        51: [2, 47],
                        55: [2, 47],
                        60: [2, 47]
                    }, {
                        5: [2, 3],
                        14: [2, 3],
                        15: [2, 3],
                        19: [2, 3],
                        29: [2, 3],
                        34: [2, 3],
                        39: [2, 3],
                        44: [2, 3],
                        47: [2, 3],
                        48: [2, 3],
                        51: [2, 3],
                        55: [2, 3],
                        60: [2, 3]
                    }, {
                        5: [2, 4],
                        14: [2, 4],
                        15: [2, 4],
                        19: [2, 4],
                        29: [2, 4],
                        34: [2, 4],
                        39: [2, 4],
                        44: [2, 4],
                        47: [2, 4],
                        48: [2, 4],
                        51: [2, 4],
                        55: [2, 4],
                        60: [2, 4]
                    }, {
                        5: [2, 5],
                        14: [2, 5],
                        15: [2, 5],
                        19: [2, 5],
                        29: [2, 5],
                        34: [2, 5],
                        39: [2, 5],
                        44: [2, 5],
                        47: [2, 5],
                        48: [2, 5],
                        51: [2, 5],
                        55: [2, 5],
                        60: [2, 5]
                    }, {
                        5: [2, 6],
                        14: [2, 6],
                        15: [2, 6],
                        19: [2, 6],
                        29: [2, 6],
                        34: [2, 6],
                        39: [2, 6],
                        44: [2, 6],
                        47: [2, 6],
                        48: [2, 6],
                        51: [2, 6],
                        55: [2, 6],
                        60: [2, 6]
                    }, {
                        5: [2, 7],
                        14: [2, 7],
                        15: [2, 7],
                        19: [2, 7],
                        29: [2, 7],
                        34: [2, 7],
                        39: [2, 7],
                        44: [2, 7],
                        47: [2, 7],
                        48: [2, 7],
                        51: [2, 7],
                        55: [2, 7],
                        60: [2, 7]
                    }, {
                        5: [2, 8],
                        14: [2, 8],
                        15: [2, 8],
                        19: [2, 8],
                        29: [2, 8],
                        34: [2, 8],
                        39: [2, 8],
                        44: [2, 8],
                        47: [2, 8],
                        48: [2, 8],
                        51: [2, 8],
                        55: [2, 8],
                        60: [2, 8]
                    }, {
                        5: [2, 9],
                        14: [2, 9],
                        15: [2, 9],
                        19: [2, 9],
                        29: [2, 9],
                        34: [2, 9],
                        39: [2, 9],
                        44: [2, 9],
                        47: [2, 9],
                        48: [2, 9],
                        51: [2, 9],
                        55: [2, 9],
                        60: [2, 9]
                    }, {
                        20: 25,
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        20: 36,
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        4: 37,
                        6: 3,
                        14: [2, 46],
                        15: [2, 46],
                        19: [2, 46],
                        29: [2, 46],
                        34: [2, 46],
                        39: [2, 46],
                        44: [2, 46],
                        47: [2, 46],
                        48: [2, 46],
                        51: [2, 46],
                        55: [2, 46],
                        60: [2, 46]
                    }, {
                        4: 38,
                        6: 3,
                        14: [2, 46],
                        15: [2, 46],
                        19: [2, 46],
                        29: [2, 46],
                        34: [2, 46],
                        44: [2, 46],
                        47: [2, 46],
                        48: [2, 46],
                        51: [2, 46],
                        55: [2, 46],
                        60: [2, 46]
                    }, {
                        13: 40,
                        15: [1, 20],
                        17: 39
                    }, {
                        20: 42,
                        56: 41,
                        64: 43,
                        65: [1, 44],
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        4: 45,
                        6: 3,
                        14: [2, 46],
                        15: [2, 46],
                        19: [2, 46],
                        29: [2, 46],
                        34: [2, 46],
                        47: [2, 46],
                        48: [2, 46],
                        51: [2, 46],
                        55: [2, 46],
                        60: [2, 46]
                    }, {
                        5: [2, 10],
                        14: [2, 10],
                        15: [2, 10],
                        18: [2, 10],
                        19: [2, 10],
                        29: [2, 10],
                        34: [2, 10],
                        39: [2, 10],
                        44: [2, 10],
                        47: [2, 10],
                        48: [2, 10],
                        51: [2, 10],
                        55: [2, 10],
                        60: [2, 10]
                    }, {
                        20: 46,
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        20: 47,
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        20: 48,
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        20: 42,
                        56: 49,
                        64: 43,
                        65: [1, 44],
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        33: [2, 78],
                        49: 50,
                        65: [2, 78],
                        72: [2, 78],
                        80: [2, 78],
                        81: [2, 78],
                        82: [2, 78],
                        83: [2, 78],
                        84: [2, 78],
                        85: [2, 78]
                    }, {
                        23: [2, 33],
                        33: [2, 33],
                        54: [2, 33],
                        65: [2, 33],
                        68: [2, 33],
                        72: [2, 33],
                        75: [2, 33],
                        80: [2, 33],
                        81: [2, 33],
                        82: [2, 33],
                        83: [2, 33],
                        84: [2, 33],
                        85: [2, 33]
                    }, {
                        23: [2, 34],
                        33: [2, 34],
                        54: [2, 34],
                        65: [2, 34],
                        68: [2, 34],
                        72: [2, 34],
                        75: [2, 34],
                        80: [2, 34],
                        81: [2, 34],
                        82: [2, 34],
                        83: [2, 34],
                        84: [2, 34],
                        85: [2, 34]
                    }, {
                        23: [2, 35],
                        33: [2, 35],
                        54: [2, 35],
                        65: [2, 35],
                        68: [2, 35],
                        72: [2, 35],
                        75: [2, 35],
                        80: [2, 35],
                        81: [2, 35],
                        82: [2, 35],
                        83: [2, 35],
                        84: [2, 35],
                        85: [2, 35]
                    }, {
                        23: [2, 36],
                        33: [2, 36],
                        54: [2, 36],
                        65: [2, 36],
                        68: [2, 36],
                        72: [2, 36],
                        75: [2, 36],
                        80: [2, 36],
                        81: [2, 36],
                        82: [2, 36],
                        83: [2, 36],
                        84: [2, 36],
                        85: [2, 36]
                    }, {
                        23: [2, 37],
                        33: [2, 37],
                        54: [2, 37],
                        65: [2, 37],
                        68: [2, 37],
                        72: [2, 37],
                        75: [2, 37],
                        80: [2, 37],
                        81: [2, 37],
                        82: [2, 37],
                        83: [2, 37],
                        84: [2, 37],
                        85: [2, 37]
                    }, {
                        23: [2, 38],
                        33: [2, 38],
                        54: [2, 38],
                        65: [2, 38],
                        68: [2, 38],
                        72: [2, 38],
                        75: [2, 38],
                        80: [2, 38],
                        81: [2, 38],
                        82: [2, 38],
                        83: [2, 38],
                        84: [2, 38],
                        85: [2, 38]
                    }, {
                        23: [2, 39],
                        33: [2, 39],
                        54: [2, 39],
                        65: [2, 39],
                        68: [2, 39],
                        72: [2, 39],
                        75: [2, 39],
                        80: [2, 39],
                        81: [2, 39],
                        82: [2, 39],
                        83: [2, 39],
                        84: [2, 39],
                        85: [2, 39]
                    }, {
                        23: [2, 43],
                        33: [2, 43],
                        54: [2, 43],
                        65: [2, 43],
                        68: [2, 43],
                        72: [2, 43],
                        75: [2, 43],
                        80: [2, 43],
                        81: [2, 43],
                        82: [2, 43],
                        83: [2, 43],
                        84: [2, 43],
                        85: [2, 43],
                        87: [1, 51]
                    }, {
                        72: [1, 35],
                        86: 52
                    }, {
                        23: [2, 45],
                        33: [2, 45],
                        54: [2, 45],
                        65: [2, 45],
                        68: [2, 45],
                        72: [2, 45],
                        75: [2, 45],
                        80: [2, 45],
                        81: [2, 45],
                        82: [2, 45],
                        83: [2, 45],
                        84: [2, 45],
                        85: [2, 45],
                        87: [2, 45]
                    }, {
                        52: 53,
                        54: [2, 82],
                        65: [2, 82],
                        72: [2, 82],
                        80: [2, 82],
                        81: [2, 82],
                        82: [2, 82],
                        83: [2, 82],
                        84: [2, 82],
                        85: [2, 82]
                    }, {
                        25: 54,
                        38: 56,
                        39: [1, 58],
                        43: 57,
                        44: [1, 59],
                        45: 55,
                        47: [2, 54]
                    }, {
                        28: 60,
                        43: 61,
                        44: [1, 59],
                        47: [2, 56]
                    }, {
                        13: 63,
                        15: [1, 20],
                        18: [1, 62]
                    }, {
                        15: [2, 48],
                        18: [2, 48]
                    }, {
                        33: [2, 86],
                        57: 64,
                        65: [2, 86],
                        72: [2, 86],
                        80: [2, 86],
                        81: [2, 86],
                        82: [2, 86],
                        83: [2, 86],
                        84: [2, 86],
                        85: [2, 86]
                    }, {
                        33: [2, 40],
                        65: [2, 40],
                        72: [2, 40],
                        80: [2, 40],
                        81: [2, 40],
                        82: [2, 40],
                        83: [2, 40],
                        84: [2, 40],
                        85: [2, 40]
                    }, {
                        33: [2, 41],
                        65: [2, 41],
                        72: [2, 41],
                        80: [2, 41],
                        81: [2, 41],
                        82: [2, 41],
                        83: [2, 41],
                        84: [2, 41],
                        85: [2, 41]
                    }, {
                        20: 65,
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        26: 66,
                        47: [1, 67]
                    }, {
                        30: 68,
                        33: [2, 58],
                        65: [2, 58],
                        72: [2, 58],
                        75: [2, 58],
                        80: [2, 58],
                        81: [2, 58],
                        82: [2, 58],
                        83: [2, 58],
                        84: [2, 58],
                        85: [2, 58]
                    }, {
                        33: [2, 64],
                        35: 69,
                        65: [2, 64],
                        72: [2, 64],
                        75: [2, 64],
                        80: [2, 64],
                        81: [2, 64],
                        82: [2, 64],
                        83: [2, 64],
                        84: [2, 64],
                        85: [2, 64]
                    }, {
                        21: 70,
                        23: [2, 50],
                        65: [2, 50],
                        72: [2, 50],
                        80: [2, 50],
                        81: [2, 50],
                        82: [2, 50],
                        83: [2, 50],
                        84: [2, 50],
                        85: [2, 50]
                    }, {
                        33: [2, 90],
                        61: 71,
                        65: [2, 90],
                        72: [2, 90],
                        80: [2, 90],
                        81: [2, 90],
                        82: [2, 90],
                        83: [2, 90],
                        84: [2, 90],
                        85: [2, 90]
                    }, {
                        20: 75,
                        33: [2, 80],
                        50: 72,
                        63: 73,
                        64: 76,
                        65: [1, 44],
                        69: 74,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        72: [1, 80]
                    }, {
                        23: [2, 42],
                        33: [2, 42],
                        54: [2, 42],
                        65: [2, 42],
                        68: [2, 42],
                        72: [2, 42],
                        75: [2, 42],
                        80: [2, 42],
                        81: [2, 42],
                        82: [2, 42],
                        83: [2, 42],
                        84: [2, 42],
                        85: [2, 42],
                        87: [1, 51]
                    }, {
                        20: 75,
                        53: 81,
                        54: [2, 84],
                        63: 82,
                        64: 76,
                        65: [1, 44],
                        69: 83,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        26: 84,
                        47: [1, 67]
                    }, {
                        47: [2, 55]
                    }, {
                        4: 85,
                        6: 3,
                        14: [2, 46],
                        15: [2, 46],
                        19: [2, 46],
                        29: [2, 46],
                        34: [2, 46],
                        39: [2, 46],
                        44: [2, 46],
                        47: [2, 46],
                        48: [2, 46],
                        51: [2, 46],
                        55: [2, 46],
                        60: [2, 46]
                    }, {
                        47: [2, 20]
                    }, {
                        20: 86,
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        4: 87,
                        6: 3,
                        14: [2, 46],
                        15: [2, 46],
                        19: [2, 46],
                        29: [2, 46],
                        34: [2, 46],
                        47: [2, 46],
                        48: [2, 46],
                        51: [2, 46],
                        55: [2, 46],
                        60: [2, 46]
                    }, {
                        26: 88,
                        47: [1, 67]
                    }, {
                        47: [2, 57]
                    }, {
                        5: [2, 11],
                        14: [2, 11],
                        15: [2, 11],
                        19: [2, 11],
                        29: [2, 11],
                        34: [2, 11],
                        39: [2, 11],
                        44: [2, 11],
                        47: [2, 11],
                        48: [2, 11],
                        51: [2, 11],
                        55: [2, 11],
                        60: [2, 11]
                    }, {
                        15: [2, 49],
                        18: [2, 49]
                    }, {
                        20: 75,
                        33: [2, 88],
                        58: 89,
                        63: 90,
                        64: 76,
                        65: [1, 44],
                        69: 91,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        65: [2, 94],
                        66: 92,
                        68: [2, 94],
                        72: [2, 94],
                        80: [2, 94],
                        81: [2, 94],
                        82: [2, 94],
                        83: [2, 94],
                        84: [2, 94],
                        85: [2, 94]
                    }, {
                        5: [2, 25],
                        14: [2, 25],
                        15: [2, 25],
                        19: [2, 25],
                        29: [2, 25],
                        34: [2, 25],
                        39: [2, 25],
                        44: [2, 25],
                        47: [2, 25],
                        48: [2, 25],
                        51: [2, 25],
                        55: [2, 25],
                        60: [2, 25]
                    }, {
                        20: 93,
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        20: 75,
                        31: 94,
                        33: [2, 60],
                        63: 95,
                        64: 76,
                        65: [1, 44],
                        69: 96,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        75: [2, 60],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        20: 75,
                        33: [2, 66],
                        36: 97,
                        63: 98,
                        64: 76,
                        65: [1, 44],
                        69: 99,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        75: [2, 66],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        20: 75,
                        22: 100,
                        23: [2, 52],
                        63: 101,
                        64: 76,
                        65: [1, 44],
                        69: 102,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        20: 75,
                        33: [2, 92],
                        62: 103,
                        63: 104,
                        64: 76,
                        65: [1, 44],
                        69: 105,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        33: [1, 106]
                    }, {
                        33: [2, 79],
                        65: [2, 79],
                        72: [2, 79],
                        80: [2, 79],
                        81: [2, 79],
                        82: [2, 79],
                        83: [2, 79],
                        84: [2, 79],
                        85: [2, 79]
                    }, {
                        33: [2, 81]
                    }, {
                        23: [2, 27],
                        33: [2, 27],
                        54: [2, 27],
                        65: [2, 27],
                        68: [2, 27],
                        72: [2, 27],
                        75: [2, 27],
                        80: [2, 27],
                        81: [2, 27],
                        82: [2, 27],
                        83: [2, 27],
                        84: [2, 27],
                        85: [2, 27]
                    }, {
                        23: [2, 28],
                        33: [2, 28],
                        54: [2, 28],
                        65: [2, 28],
                        68: [2, 28],
                        72: [2, 28],
                        75: [2, 28],
                        80: [2, 28],
                        81: [2, 28],
                        82: [2, 28],
                        83: [2, 28],
                        84: [2, 28],
                        85: [2, 28]
                    }, {
                        23: [2, 30],
                        33: [2, 30],
                        54: [2, 30],
                        68: [2, 30],
                        71: 107,
                        72: [1, 108],
                        75: [2, 30]
                    }, {
                        23: [2, 98],
                        33: [2, 98],
                        54: [2, 98],
                        68: [2, 98],
                        72: [2, 98],
                        75: [2, 98]
                    }, {
                        23: [2, 45],
                        33: [2, 45],
                        54: [2, 45],
                        65: [2, 45],
                        68: [2, 45],
                        72: [2, 45],
                        73: [1, 109],
                        75: [2, 45],
                        80: [2, 45],
                        81: [2, 45],
                        82: [2, 45],
                        83: [2, 45],
                        84: [2, 45],
                        85: [2, 45],
                        87: [2, 45]
                    }, {
                        23: [2, 44],
                        33: [2, 44],
                        54: [2, 44],
                        65: [2, 44],
                        68: [2, 44],
                        72: [2, 44],
                        75: [2, 44],
                        80: [2, 44],
                        81: [2, 44],
                        82: [2, 44],
                        83: [2, 44],
                        84: [2, 44],
                        85: [2, 44],
                        87: [2, 44]
                    }, {
                        54: [1, 110]
                    }, {
                        54: [2, 83],
                        65: [2, 83],
                        72: [2, 83],
                        80: [2, 83],
                        81: [2, 83],
                        82: [2, 83],
                        83: [2, 83],
                        84: [2, 83],
                        85: [2, 83]
                    }, {
                        54: [2, 85]
                    }, {
                        5: [2, 13],
                        14: [2, 13],
                        15: [2, 13],
                        19: [2, 13],
                        29: [2, 13],
                        34: [2, 13],
                        39: [2, 13],
                        44: [2, 13],
                        47: [2, 13],
                        48: [2, 13],
                        51: [2, 13],
                        55: [2, 13],
                        60: [2, 13]
                    }, {
                        38: 56,
                        39: [1, 58],
                        43: 57,
                        44: [1, 59],
                        45: 112,
                        46: 111,
                        47: [2, 76]
                    }, {
                        33: [2, 70],
                        40: 113,
                        65: [2, 70],
                        72: [2, 70],
                        75: [2, 70],
                        80: [2, 70],
                        81: [2, 70],
                        82: [2, 70],
                        83: [2, 70],
                        84: [2, 70],
                        85: [2, 70]
                    }, {
                        47: [2, 18]
                    }, {
                        5: [2, 14],
                        14: [2, 14],
                        15: [2, 14],
                        19: [2, 14],
                        29: [2, 14],
                        34: [2, 14],
                        39: [2, 14],
                        44: [2, 14],
                        47: [2, 14],
                        48: [2, 14],
                        51: [2, 14],
                        55: [2, 14],
                        60: [2, 14]
                    }, {
                        33: [1, 114]
                    }, {
                        33: [2, 87],
                        65: [2, 87],
                        72: [2, 87],
                        80: [2, 87],
                        81: [2, 87],
                        82: [2, 87],
                        83: [2, 87],
                        84: [2, 87],
                        85: [2, 87]
                    }, {
                        33: [2, 89]
                    }, {
                        20: 75,
                        63: 116,
                        64: 76,
                        65: [1, 44],
                        67: 115,
                        68: [2, 96],
                        69: 117,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        33: [1, 118]
                    }, {
                        32: 119,
                        33: [2, 62],
                        74: 120,
                        75: [1, 121]
                    }, {
                        33: [2, 59],
                        65: [2, 59],
                        72: [2, 59],
                        75: [2, 59],
                        80: [2, 59],
                        81: [2, 59],
                        82: [2, 59],
                        83: [2, 59],
                        84: [2, 59],
                        85: [2, 59]
                    }, {
                        33: [2, 61],
                        75: [2, 61]
                    }, {
                        33: [2, 68],
                        37: 122,
                        74: 123,
                        75: [1, 121]
                    }, {
                        33: [2, 65],
                        65: [2, 65],
                        72: [2, 65],
                        75: [2, 65],
                        80: [2, 65],
                        81: [2, 65],
                        82: [2, 65],
                        83: [2, 65],
                        84: [2, 65],
                        85: [2, 65]
                    }, {
                        33: [2, 67],
                        75: [2, 67]
                    }, {
                        23: [1, 124]
                    }, {
                        23: [2, 51],
                        65: [2, 51],
                        72: [2, 51],
                        80: [2, 51],
                        81: [2, 51],
                        82: [2, 51],
                        83: [2, 51],
                        84: [2, 51],
                        85: [2, 51]
                    }, {
                        23: [2, 53]
                    }, {
                        33: [1, 125]
                    }, {
                        33: [2, 91],
                        65: [2, 91],
                        72: [2, 91],
                        80: [2, 91],
                        81: [2, 91],
                        82: [2, 91],
                        83: [2, 91],
                        84: [2, 91],
                        85: [2, 91]
                    }, {
                        33: [2, 93]
                    }, {
                        5: [2, 22],
                        14: [2, 22],
                        15: [2, 22],
                        19: [2, 22],
                        29: [2, 22],
                        34: [2, 22],
                        39: [2, 22],
                        44: [2, 22],
                        47: [2, 22],
                        48: [2, 22],
                        51: [2, 22],
                        55: [2, 22],
                        60: [2, 22]
                    }, {
                        23: [2, 99],
                        33: [2, 99],
                        54: [2, 99],
                        68: [2, 99],
                        72: [2, 99],
                        75: [2, 99]
                    }, {
                        73: [1, 109]
                    }, {
                        20: 75,
                        63: 126,
                        64: 76,
                        65: [1, 44],
                        72: [1, 35],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        5: [2, 23],
                        14: [2, 23],
                        15: [2, 23],
                        19: [2, 23],
                        29: [2, 23],
                        34: [2, 23],
                        39: [2, 23],
                        44: [2, 23],
                        47: [2, 23],
                        48: [2, 23],
                        51: [2, 23],
                        55: [2, 23],
                        60: [2, 23]
                    }, {
                        47: [2, 19]
                    }, {
                        47: [2, 77]
                    }, {
                        20: 75,
                        33: [2, 72],
                        41: 127,
                        63: 128,
                        64: 76,
                        65: [1, 44],
                        69: 129,
                        70: 77,
                        71: 78,
                        72: [1, 79],
                        75: [2, 72],
                        78: 26,
                        79: 27,
                        80: [1, 28],
                        81: [1, 29],
                        82: [1, 30],
                        83: [1, 31],
                        84: [1, 32],
                        85: [1, 34],
                        86: 33
                    }, {
                        5: [2, 24],
                        14: [2, 24],
                        15: [2, 24],
                        19: [2, 24],
                        29: [2, 24],
                        34: [2, 24],
                        39: [2, 24],
                        44: [2, 24],
                        47: [2, 24],
                        48: [2, 24],
                        51: [2, 24],
                        55: [2, 24],
                        60: [2, 24]
                    }, {
                        68: [1, 130]
                    }, {
                        65: [2, 95],
                        68: [2, 95],
                        72: [2, 95],
                        80: [2, 95],
                        81: [2, 95],
                        82: [2, 95],
                        83: [2, 95],
                        84: [2, 95],
                        85: [2, 95]
                    }, {
                        68: [2, 97]
                    }, {
                        5: [2, 21],
                        14: [2, 21],
                        15: [2, 21],
                        19: [2, 21],
                        29: [2, 21],
                        34: [2, 21],
                        39: [2, 21],
                        44: [2, 21],
                        47: [2, 21],
                        48: [2, 21],
                        51: [2, 21],
                        55: [2, 21],
                        60: [2, 21]
                    }, {
                        33: [1, 131]
                    }, {
                        33: [2, 63]
                    }, {
                        72: [1, 133],
                        76: 132
                    }, {
                        33: [1, 134]
                    }, {
                        33: [2, 69]
                    }, {
                        15: [2, 12]
                    }, {
                        14: [2, 26],
                        15: [2, 26],
                        19: [2, 26],
                        29: [2, 26],
                        34: [2, 26],
                        47: [2, 26],
                        48: [2, 26],
                        51: [2, 26],
                        55: [2, 26],
                        60: [2, 26]
                    }, {
                        23: [2, 31],
                        33: [2, 31],
                        54: [2, 31],
                        68: [2, 31],
                        72: [2, 31],
                        75: [2, 31]
                    }, {
                        33: [2, 74],
                        42: 135,
                        74: 136,
                        75: [1, 121]
                    }, {
                        33: [2, 71],
                        65: [2, 71],
                        72: [2, 71],
                        75: [2, 71],
                        80: [2, 71],
                        81: [2, 71],
                        82: [2, 71],
                        83: [2, 71],
                        84: [2, 71],
                        85: [2, 71]
                    }, {
                        33: [2, 73],
                        75: [2, 73]
                    }, {
                        23: [2, 29],
                        33: [2, 29],
                        54: [2, 29],
                        65: [2, 29],
                        68: [2, 29],
                        72: [2, 29],
                        75: [2, 29],
                        80: [2, 29],
                        81: [2, 29],
                        82: [2, 29],
                        83: [2, 29],
                        84: [2, 29],
                        85: [2, 29]
                    }, {
                        14: [2, 15],
                        15: [2, 15],
                        19: [2, 15],
                        29: [2, 15],
                        34: [2, 15],
                        39: [2, 15],
                        44: [2, 15],
                        47: [2, 15],
                        48: [2, 15],
                        51: [2, 15],
                        55: [2, 15],
                        60: [2, 15]
                    }, {
                        72: [1, 138],
                        77: [1, 137]
                    }, {
                        72: [2, 100],
                        77: [2, 100]
                    }, {
                        14: [2, 16],
                        15: [2, 16],
                        19: [2, 16],
                        29: [2, 16],
                        34: [2, 16],
                        44: [2, 16],
                        47: [2, 16],
                        48: [2, 16],
                        51: [2, 16],
                        55: [2, 16],
                        60: [2, 16]
                    }, {
                        33: [1, 139]
                    }, {
                        33: [2, 75]
                    }, {
                        33: [2, 32]
                    }, {
                        72: [2, 101],
                        77: [2, 101]
                    }, {
                        14: [2, 17],
                        15: [2, 17],
                        19: [2, 17],
                        29: [2, 17],
                        34: [2, 17],
                        39: [2, 17],
                        44: [2, 17],
                        47: [2, 17],
                        48: [2, 17],
                        51: [2, 17],
                        55: [2, 17],
                        60: [2, 17]
                    }],
                    defaultActions: {
                        4: [2, 1],
                        55: [2, 55],
                        57: [2, 20],
                        61: [2, 57],
                        74: [2, 81],
                        83: [2, 85],
                        87: [2, 18],
                        91: [2, 89],
                        102: [2, 53],
                        105: [2, 93],
                        111: [2, 19],
                        112: [2, 77],
                        117: [2, 97],
                        120: [2, 63],
                        123: [2, 69],
                        124: [2, 12],
                        136: [2, 75],
                        137: [2, 32]
                    },
                    parseError: function(t) {
                        throw new Error(t)
                    },
                    parse: function(t) {
                        function e() {
                            var t;
                            return t = r.lexer.lex() || 1, "number" != typeof t && (t = r.symbols_[t] || t), t
                        }
                        var r = this,
                            s = [0],
                            i = [null],
                            a = [],
                            n = this.table,
                            o = "",
                            c = 0,
                            h = 0,
                            l = 0;
                        this.lexer.setInput(t), this.lexer.yy = this.yy, this.yy.lexer = this.lexer, this.yy.parser = this, "undefined" == typeof this.lexer.yylloc && (this.lexer.yylloc = {});
                        var p = this.lexer.yylloc;
                        a.push(p);
                        var u = this.lexer.options && this.lexer.options.ranges;
                        "function" == typeof this.yy.parseError && (this.parseError = this.yy.parseError);
                        for (var f, d, m, g, v, y, k, S, b, _ = {};;) {
                            if (m = s[s.length - 1], this.defaultActions[m] ? g = this.defaultActions[m] : ((null === f || "undefined" == typeof f) && (f = e()), g = n[m] && n[m][f]), "undefined" == typeof g || !g.length || !g[0]) {
                                var P = "";
                                if (!l) {
                                    b = [];
                                    for (y in n[m]) this.terminals_[y] && y > 2 && b.push("'" + this.terminals_[y] + "'");
                                    P = this.lexer.showPosition ? "Parse error on line " + (c + 1) + ":\n" + this.lexer.showPosition() + "\nExpecting " + b.join(", ") + ", got '" + (this.terminals_[f] || f) + "'" : "Parse error on line " + (c + 1) + ": Unexpected " + (1 == f ? "end of input" : "'" + (this.terminals_[f] || f) + "'"), this.parseError(P, {
                                        text: this.lexer.match,
                                        token: this.terminals_[f] || f,
                                        line: this.lexer.yylineno,
                                        loc: p,
                                        expected: b
                                    })
                                }
                            }
                            if (g[0] instanceof Array && g.length > 1) throw new Error("Parse Error: multiple actions possible at state: " + m + ", token: " + f);
                            switch (g[0]) {
                                case 1:
                                    s.push(f), i.push(this.lexer.yytext), a.push(this.lexer.yylloc), s.push(g[1]), f = null, d ? (f = d, d = null) : (h = this.lexer.yyleng, o = this.lexer.yytext, c = this.lexer.yylineno, p = this.lexer.yylloc, l > 0 && l--);
                                    break;
                                case 2:
                                    if (k = this.productions_[g[1]][1], _.$ = i[i.length - k], _._$ = {
                                            first_line: a[a.length - (k || 1)].first_line,
                                            last_line: a[a.length - 1].last_line,
                                            first_column: a[a.length - (k || 1)].first_column,
                                            last_column: a[a.length - 1].last_column
                                        }, u && (_._$.range = [a[a.length - (k || 1)].range[0], a[a.length - 1].range[1]]), v = this.performAction.call(_, o, h, c, this.yy, g[1], i, a), "undefined" != typeof v) return v;
                                    k && (s = s.slice(0, -1 * k * 2), i = i.slice(0, -1 * k), a = a.slice(0, -1 * k)), s.push(this.productions_[g[1]][0]), i.push(_.$), a.push(_._$), S = n[s[s.length - 2]][s[s.length - 1]], s.push(S);
                                    break;
                                case 3:
                                    return !0
                            }
                        }
                        return !0
                    }
                },
                r = function() {
                    var t = {
                        EOF: 1,
                        parseError: function(t, e) {
                            if (!this.yy.parser) throw new Error(t);
                            this.yy.parser.parseError(t, e)
                        },
                        setInput: function(t) {
                            return this._input = t, this._more = this._less = this.done = !1, this.yylineno = this.yyleng = 0, this.yytext = this.matched = this.match = "", this.conditionStack = ["INITIAL"], this.yylloc = {
                                first_line: 1,
                                first_column: 0,
                                last_line: 1,
                                last_column: 0
                            }, this.options.ranges && (this.yylloc.range = [0, 0]), this.offset = 0, this
                        },
                        input: function() {
                            var t = this._input[0];
                            this.yytext += t, this.yyleng++, this.offset++, this.match += t, this.matched += t;
                            var e = t.match(/(?:\r\n?|\n).*/g);
                            return e ? (this.yylineno++, this.yylloc.last_line++) : this.yylloc.last_column++, this.options.ranges && this.yylloc.range[1]++, this._input = this._input.slice(1), t
                        },
                        unput: function(t) {
                            var e = t.length,
                                r = t.split(/(?:\r\n?|\n)/g);
                            this._input = t + this._input, this.yytext = this.yytext.substr(0, this.yytext.length - e - 1), this.offset -= e;
                            var s = this.match.split(/(?:\r\n?|\n)/g);
                            this.match = this.match.substr(0, this.match.length - 1), this.matched = this.matched.substr(0, this.matched.length - 1), r.length - 1 && (this.yylineno -= r.length - 1);
                            var i = this.yylloc.range;
                            return this.yylloc = {
                                first_line: this.yylloc.first_line,
                                last_line: this.yylineno + 1,
                                first_column: this.yylloc.first_column,
                                last_column: r ? (r.length === s.length ? this.yylloc.first_column : 0) + s[s.length - r.length].length - r[0].length : this.yylloc.first_column - e
                            }, this.options.ranges && (this.yylloc.range = [i[0], i[0] + this.yyleng - e]), this
                        },
                        more: function() {
                            return this._more = !0, this
                        },
                        less: function(t) {
                            this.unput(this.match.slice(t))
                        },
                        pastInput: function() {
                            var t = this.matched.substr(0, this.matched.length - this.match.length);
                            return (t.length > 20 ? "..." : "") + t.substr(-20).replace(/\n/g, "")
                        },
                        upcomingInput: function() {
                            var t = this.match;
                            return t.length < 20 && (t += this._input.substr(0, 20 - t.length)), (t.substr(0, 20) + (t.length > 20 ? "..." : "")).replace(/\n/g, "")
                        },
                        showPosition: function() {
                            var t = this.pastInput(),
                                e = new Array(t.length + 1).join("-");
                            return t + this.upcomingInput() + "\n" + e + "^"
                        },
                        next: function() {
                            if (this.done) return this.EOF;
                            this._input || (this.done = !0);
                            var t, e, r, s, i;
                            this._more || (this.yytext = "", this.match = "");
                            for (var a = this._currentRules(), n = 0; n < a.length && (r = this._input.match(this.rules[a[n]]), !r || e && !(r[0].length > e[0].length) || (e = r, s = n, this.options.flex)); n++);
                            return e ? (i = e[0].match(/(?:\r\n?|\n).*/g), i && (this.yylineno += i.length), this.yylloc = {
                                first_line: this.yylloc.last_line,
                                last_line: this.yylineno + 1,
                                first_column: this.yylloc.last_column,
                                last_column: i ? i[i.length - 1].length - i[i.length - 1].match(/\r?\n?/)[0].length : this.yylloc.last_column + e[0].length
                            }, this.yytext += e[0], this.match += e[0], this.matches = e, this.yyleng = this.yytext.length, this.options.ranges && (this.yylloc.range = [this.offset, this.offset += this.yyleng]), this._more = !1, this._input = this._input.slice(e[0].length), this.matched += e[0], t = this.performAction.call(this, this.yy, this, a[s], this.conditionStack[this.conditionStack.length - 1]), this.done && this._input && (this.done = !1), t ? t : void 0) : "" === this._input ? this.EOF : this.parseError("Lexical error on line " + (this.yylineno + 1) + ". Unrecognized text.\n" + this.showPosition(), {
                                text: "",
                                token: null,
                                line: this.yylineno
                            })
                        },
                        lex: function() {
                            var t = this.next();
                            return "undefined" != typeof t ? t : this.lex()
                        },
                        begin: function(t) {
                            this.conditionStack.push(t)
                        },
                        popState: function() {
                            return this.conditionStack.pop()
                        },
                        _currentRules: function() {
                            return this.conditions[this.conditionStack[this.conditionStack.length - 1]].rules
                        },
                        topState: function() {
                            return this.conditionStack[this.conditionStack.length - 2]
                        },
                        pushState: function(t) {
                            this.begin(t)
                        }
                    };
                    return t.options = {}, t.performAction = function(t, e, r, s) {
                        function i(t, r) {
                            return e.yytext = e.yytext.substr(t, e.yyleng - r)
                        }
                        switch (r) {
                            case 0:
                                if ("\\\\" === e.yytext.slice(-2) ? (i(0, 1), this.begin("mu")) : "\\" === e.yytext.slice(-1) ? (i(0, 1), this.begin("emu")) : this.begin("mu"), e.yytext) return 15;
                                break;
                            case 1:
                                return 15;
                            case 2:
                                return this.popState(), 15;
                            case 3:
                                return this.begin("raw"), 15;
                            case 4:
                                return this.popState(), "raw" === this.conditionStack[this.conditionStack.length - 1] ? 15 : (e.yytext = e.yytext.substr(5, e.yyleng - 9), "END_RAW_BLOCK");
                            case 5:
                                return 15;
                            case 6:
                                return this.popState(), 14;
                            case 7:
                                return 65;
                            case 8:
                                return 68;
                            case 9:
                                return 19;
                            case 10:
                                return this.popState(), this.begin("raw"), 23;
                            case 11:
                                return 55;
                            case 12:
                                return 60;
                            case 13:
                                return 29;
                            case 14:
                                return 47;
                            case 15:
                                return this.popState(), 44;
                            case 16:
                                return this.popState(), 44;
                            case 17:
                                return 34;
                            case 18:
                                return 39;
                            case 19:
                                return 51;
                            case 20:
                                return 48;
                            case 21:
                                this.unput(e.yytext), this.popState(), this.begin("com");
                                break;
                            case 22:
                                return this.popState(), 14;
                            case 23:
                                return 48;
                            case 24:
                                return 73;
                            case 25:
                                return 72;
                            case 26:
                                return 72;
                            case 27:
                                return 87;
                            case 28:
                                break;
                            case 29:
                                return this.popState(), 54;
                            case 30:
                                return this.popState(), 33;
                            case 31:
                                return e.yytext = i(1, 2).replace(/\\"/g, '"'), 80;
                            case 32:
                                return e.yytext = i(1, 2).replace(/\\'/g, "'"), 80;
                            case 33:
                                return 85;
                            case 34:
                                return 82;
                            case 35:
                                return 82;
                            case 36:
                                return 83;
                            case 37:
                                return 84;
                            case 38:
                                return 81;
                            case 39:
                                return 75;
                            case 40:
                                return 77;
                            case 41:
                                return 72;
                            case 42:
                                return e.yytext = e.yytext.replace(/\\([\\\]])/g, "$1"), 72;
                            case 43:
                                return "INVALID";
                            case 44:
                                return 5
                        }
                    }, t.rules = [/^(?:[^\x00]*?(?=(\{\{)))/, /^(?:[^\x00]+)/, /^(?:[^\x00]{2,}?(?=(\{\{|\\\{\{|\\\\\{\{|$)))/, /^(?:\{\{\{\{(?=[^/]))/, /^(?:\{\{\{\{\/[^\s!"#%-,\.\/;->@\[-\^`\{-~]+(?=[=}\s\/.])\}\}\}\})/, /^(?:[^\x00]*?(?=(\{\{\{\{)))/, /^(?:[\s\S]*?--(~)?\}\})/, /^(?:\()/, /^(?:\))/, /^(?:\{\{\{\{)/, /^(?:\}\}\}\})/, /^(?:\{\{(~)?>)/, /^(?:\{\{(~)?#>)/, /^(?:\{\{(~)?#\*?)/, /^(?:\{\{(~)?\/)/, /^(?:\{\{(~)?\^\s*(~)?\}\})/, /^(?:\{\{(~)?\s*else\s*(~)?\}\})/, /^(?:\{\{(~)?\^)/, /^(?:\{\{(~)?\s*else\b)/, /^(?:\{\{(~)?\{)/, /^(?:\{\{(~)?&)/, /^(?:\{\{(~)?!--)/, /^(?:\{\{(~)?![\s\S]*?\}\})/, /^(?:\{\{(~)?\*?)/, /^(?:=)/, /^(?:\.\.)/, /^(?:\.(?=([=~}\s\/.)|])))/, /^(?:[\/.])/, /^(?:\s+)/, /^(?:\}(~)?\}\})/, /^(?:(~)?\}\})/, /^(?:"(\\["]|[^"])*")/, /^(?:'(\\[']|[^'])*')/, /^(?:@)/, /^(?:true(?=([~}\s)])))/, /^(?:false(?=([~}\s)])))/, /^(?:undefined(?=([~}\s)])))/, /^(?:null(?=([~}\s)])))/, /^(?:-?[0-9]+(?:\.[0-9]+)?(?=([~}\s)])))/, /^(?:as\s+\|)/, /^(?:\|)/, /^(?:([^\s!"#%-,\.\/;->@\[-\^`\{-~]+(?=([=~}\s\/.)|]))))/, /^(?:\[(\\\]|[^\]])*\])/, /^(?:.)/, /^(?:$)/], t.conditions = {
                        mu: {
                            rules: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44],
                            inclusive: !1
                        },
                        emu: {
                            rules: [2],
                            inclusive: !1
                        },
                        com: {
                            rules: [6],
                            inclusive: !1
                        },
                        raw: {
                            rules: [3, 4, 5],
                            inclusive: !1
                        },
                        INITIAL: {
                            rules: [0, 1, 44],
                            inclusive: !0
                        }
                    }, t
                }();
            return e.lexer = r, t.prototype = e, e.Parser = t, new t
        }();
        e.__esModule = !0, e["default"] = r
    }, function(t, e, r) {
        "use strict";

        function s() {
            var t = arguments.length <= 0 || void 0 === arguments[0] ? {} : arguments[0];
            this.options = t
        }

        function i(t, e, r) {
            void 0 === e && (e = t.length);
            var s = t[e - 1],
                i = t[e - 2];
            return s ? "ContentStatement" === s.type ? (i || !r ? /\r?\n\s*?$/ : /(^|\r?\n)\s*?$/).test(s.original) : void 0 : r
        }

        function a(t, e, r) {
            void 0 === e && (e = -1);
            var s = t[e + 1],
                i = t[e + 2];
            return s ? "ContentStatement" === s.type ? (i || !r ? /^\s*?\r?\n/ : /^\s*?(\r?\n|$)/).test(s.original) : void 0 : r
        }

        function n(t, e, r) {
            var s = t[null == e ? 0 : e + 1];
            if (s && "ContentStatement" === s.type && (r || !s.rightStripped)) {
                var i = s.value;
                s.value = s.value.replace(r ? /^\s+/ : /^[ \t]*\r?\n?/, ""), s.rightStripped = s.value !== i
            }
        }

        function o(t, e, r) {
            var s = t[null == e ? t.length - 1 : e - 1];
            if (s && "ContentStatement" === s.type && (r || !s.leftStripped)) {
                var i = s.value;
                return s.value = s.value.replace(r ? /\s+$/ : /[ \t]+$/, ""), s.leftStripped = s.value !== i, s.leftStripped
            }
        }
        var c = r(8)["default"];
        e.__esModule = !0;
        var h = r(6),
            l = c(h);
        s.prototype = new l["default"], s.prototype.Program = function(t) {
            var e = !this.options.ignoreStandalone,
                r = !this.isRootSeen;
            this.isRootSeen = !0;
            for (var s = t.body, c = 0, h = s.length; h > c; c++) {
                var l = s[c],
                    p = this.accept(l);
                if (p) {
                    var u = i(s, c, r),
                        f = a(s, c, r),
                        d = p.openStandalone && u,
                        m = p.closeStandalone && f,
                        g = p.inlineStandalone && u && f;
                    p.close && n(s, c, !0), p.open && o(s, c, !0), e && g && (n(s, c), o(s, c) && "PartialStatement" === l.type && (l.indent = /([ \t]+$)/.exec(s[c - 1].original)[1])), e && d && (n((l.program || l.inverse).body), o(s, c)), e && m && (n(s, c), o((l.inverse || l.program).body))
                }
            }
            return t
        }, s.prototype.BlockStatement = s.prototype.DecoratorBlock = s.prototype.PartialBlockStatement = function(t) {
            this.accept(t.program), this.accept(t.inverse);
            var e = t.program || t.inverse,
                r = t.program && t.inverse,
                s = r,
                c = r;
            if (r && r.chained)
                for (s = r.body[0].program; c.chained;) c = c.body[c.body.length - 1].program;
            var h = {
                open: t.openStrip.open,
                close: t.closeStrip.close,
                openStandalone: a(e.body),
                closeStandalone: i((s || e).body)
            };
            if (t.openStrip.close && n(e.body, null, !0), r) {
                var l = t.inverseStrip;
                l.open && o(e.body, null, !0), l.close && n(s.body, null, !0), t.closeStrip.open && o(c.body, null, !0), !this.options.ignoreStandalone && i(e.body) && a(s.body) && (o(e.body), n(s.body))
            } else t.closeStrip.open && o(e.body, null, !0);
            return h
        }, s.prototype.Decorator = s.prototype.MustacheStatement = function(t) {
            return t.strip
        }, s.prototype.PartialStatement = s.prototype.CommentStatement = function(t) {
            var e = t.strip || {};
            return {
                inlineStandalone: !0,
                open: e.open,
                close: e.close
            }
        }, e["default"] = s, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";

        function s(t, e) {
            if (e = e.path ? e.path.original : e, t.path.original !== e) {
                var r = {
                    loc: t.path.loc
                };
                throw new g["default"](t.path.original + " doesn't match " + e, r)
            }
        }

        function i(t, e) {
            this.source = t, this.start = {
                line: e.first_line,
                column: e.first_column
            }, this.end = {
                line: e.last_line,
                column: e.last_column
            }
        }

        function a(t) {
            return /^\[.*\]$/.test(t) ? t.substr(1, t.length - 2) : t
        }

        function n(t, e) {
            return {
                open: "~" === t.charAt(2),
                close: "~" === e.charAt(e.length - 3)
            }
        }

        function o(t) {
            return t.replace(/^\{\{~?\!-?-?/, "").replace(/-?-?~?\}\}$/, "")
        }

        function c(t, e, r) {
            r = this.locInfo(r);
            for (var s = t ? "@" : "", i = [], a = 0, n = "", o = 0, c = e.length; c > o; o++) {
                var h = e[o].part,
                    l = e[o].original !== h;
                if (s += (e[o].separator || "") + h, l || ".." !== h && "." !== h && "this" !== h) i.push(h);
                else {
                    if (i.length > 0) throw new g["default"]("Invalid path: " + s, {
                        loc: r
                    });
                    ".." === h && (a++, n += "../")
                }
            }
            return {
                type: "PathExpression",
                data: t,
                depth: a,
                parts: i,
                original: s,
                loc: r
            }
        }

        function h(t, e, r, s, i, a) {
            var n = s.charAt(3) || s.charAt(2),
                o = "{" !== n && "&" !== n,
                c = /\*/.test(s);
            return {
                type: c ? "Decorator" : "MustacheStatement",
                path: t,
                params: e,
                hash: r,
                escaped: o,
                strip: i,
                loc: this.locInfo(a)
            }
        }

        function l(t, e, r, i) {
            s(t, r), i = this.locInfo(i);
            var a = {
                type: "Program",
                body: e,
                strip: {},
                loc: i
            };
            return {
                type: "BlockStatement",
                path: t.path,
                params: t.params,
                hash: t.hash,
                program: a,
                openStrip: {},
                inverseStrip: {},
                closeStrip: {},
                loc: i
            }
        }

        function p(t, e, r, i, a, n) {
            i && i.path && s(t, i);
            var o = /\*/.test(t.open);
            e.blockParams = t.blockParams;
            var c = void 0,
                h = void 0;
            if (r) {
                if (o) throw new g["default"]("Unexpected inverse block on decorator", r);
                r.chain && (r.program.body[0].closeStrip = i.strip), h = r.strip, c = r.program
            }
            return a && (a = c, c = e, e = a), {
                type: o ? "DecoratorBlock" : "BlockStatement",
                path: t.path,
                params: t.params,
                hash: t.hash,
                program: e,
                inverse: c,
                openStrip: t.strip,
                inverseStrip: h,
                closeStrip: i && i.strip,
                loc: this.locInfo(n)
            }
        }

        function u(t, e) {
            if (!e && t.length) {
                var r = t[0].loc,
                    s = t[t.length - 1].loc;
                r && s && (e = {
                    source: r.source,
                    start: {
                        line: r.start.line,
                        column: r.start.column
                    },
                    end: {
                        line: s.end.line,
                        column: s.end.column
                    }
                })
            }
            return {
                type: "Program",
                body: t,
                strip: {},
                loc: e
            }
        }

        function f(t, e, r, i) {
            return s(t, r), {
                type: "PartialBlockStatement",
                name: t.path,
                params: t.params,
                hash: t.hash,
                program: e,
                openStrip: t.strip,
                closeStrip: r && r.strip,
                loc: this.locInfo(i)
            }
        }
        var d = r(8)["default"];
        e.__esModule = !0, e.SourceLocation = i, e.id = a, e.stripFlags = n, e.stripComment = o, e.preparePath = c, e.prepareMustache = h, e.prepareRawBlock = l, e.prepareBlock = p, e.prepareProgram = u, e.preparePartialBlock = f;
        var m = r(12),
            g = d(m)
    }, function(t, e, r) {
        "use strict";

        function s(t, e, r) {
            if (a.isArray(t)) {
                for (var s = [], i = 0, n = t.length; n > i; i++) s.push(e.wrap(t[i], r));
                return s
            }
            return "boolean" == typeof t || "number" == typeof t ? t + "" : t
        }

        function i(t) {
            this.srcFile = t, this.source = []
        }
        e.__esModule = !0;
        var a = r(13),
            n = void 0;
        try {} catch (o) {}
        n || (n = function(t, e, r, s) {
            this.src = "", s && this.add(s)
        }, n.prototype = {
            add: function(t) {
                a.isArray(t) && (t = t.join("")), this.src += t
            },
            prepend: function(t) {
                a.isArray(t) && (t = t.join("")), this.src = t + this.src
            },
            toStringWithSourceMap: function() {
                return {
                    code: this.toString()
                }
            },
            toString: function() {
                return this.src
            }
        }), i.prototype = {
            isEmpty: function() {
                return !this.source.length
            },
            prepend: function(t, e) {
                this.source.unshift(this.wrap(t, e))
            },
            push: function(t, e) {
                this.source.push(this.wrap(t, e))
            },
            merge: function() {
                var t = this.empty();
                return this.each(function(e) {
                    t.add(["  ", e, "\n"])
                }), t
            },
            each: function(t) {
                for (var e = 0, r = this.source.length; r > e; e++) t(this.source[e])
            },
            empty: function() {
                var t = this.currentLocation || {
                    start: {}
                };
                return new n(t.start.line, t.start.column, this.srcFile)
            },
            wrap: function(t) {
                var e = arguments.length <= 1 || void 0 === arguments[1] ? this.currentLocation || {
                    start: {}
                } : arguments[1];
                return t instanceof n ? t : (t = s(t, this, e), new n(e.start.line, e.start.column, this.srcFile, t))
            },
            functionCall: function(t, e, r) {
                return r = this.generateList(r), this.wrap([t, e ? "." + e + "(" : "(", r, ")"])
            },
            quotedString: function(t) {
                return '"' + (t + "").replace(/\\/g, "\\\\").replace(/"/g, '\\"').replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\u2028/g, "\\u2028").replace(/\u2029/g, "\\u2029") + '"'
            },
            objectLiteral: function(t) {
                var e = [];
                for (var r in t)
                    if (t.hasOwnProperty(r)) {
                        var i = s(t[r], this);
                        "undefined" !== i && e.push([this.quotedString(r), ":", i])
                    }
                var a = this.generateList(e);
                return a.prepend("{"), a.add("}"), a
            },
            generateList: function(t) {
                for (var e = this.empty(), r = 0, i = t.length; i > r; r++) r && e.add(","), e.add(s(t[r], this));
                return e
            },
            generateArray: function(t) {
                var e = this.generateList(t);
                return e.prepend("["), e.add("]"), e
            }
        }, e["default"] = i, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";

        function s(t) {
            n["default"](t), c["default"](t), l["default"](t), u["default"](t), d["default"](t), g["default"](t), y["default"](t)
        }
        var i = r(8)["default"];
        e.__esModule = !0, e.registerDefaultHelpers = s;
        var a = r(22),
            n = i(a),
            o = r(23),
            c = i(o),
            h = r(24),
            l = i(h),
            p = r(25),
            u = i(p),
            f = r(26),
            d = i(f),
            m = r(27),
            g = i(m),
            v = r(28),
            y = i(v)
    }, function(t, e, r) {
        "use strict";

        function s(t) {
            n["default"](t)
        }
        var i = r(8)["default"];
        e.__esModule = !0, e.registerDefaultDecorators = s;
        var a = r(29),
            n = i(a)
    }, function(t, e, r) {
        "use strict";
        e.__esModule = !0;
        var s = r(13),
            i = {
                methodMap: ["debug", "info", "warn", "error"],
                level: "info",
                lookupLevel: function(t) {
                    if ("string" == typeof t) {
                        var e = s.indexOf(i.methodMap, t.toLowerCase());
                        t = e >= 0 ? e : parseInt(t, 10)
                    }
                    return t
                },
                log: function(t) {
                    if (t = i.lookupLevel(t), "undefined" != typeof console && i.lookupLevel(i.level) <= t) {
                        var e = i.methodMap[t];
                        console[e] || (e = "log");
                        for (var r = arguments.length, s = Array(r > 1 ? r - 1 : 0), a = 1; r > a; a++) s[a - 1] = arguments[a];
                        console[e].apply(console, s)
                    }
                }
            };
        e["default"] = i, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";
        e.__esModule = !0;
        var s = r(13);
        e["default"] = function(t) {
            t.registerHelper("blockHelperMissing", function(e, r) {
                var i = r.inverse,
                    a = r.fn;
                if (e === !0) return a(this);
                if (e === !1 || null == e) return i(this);
                if (s.isArray(e)) return e.length > 0 ? (r.ids && (r.ids = [r.name]), t.helpers.each(e, r)) : i(this);
                if (r.data && r.ids) {
                    var n = s.createFrame(r.data);
                    n.contextPath = s.appendContextPath(r.data.contextPath, r.name), r = {
                        data: n
                    }
                }
                return a(e, r)
            })
        }, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";
        var s = r(8)["default"];
        e.__esModule = !0;
        var i = r(13),
            a = r(12),
            n = s(a);
        e["default"] = function(t) {
            t.registerHelper("each", function(t, e) {
                function r(e, r, a) {
                    h && (h.key = e, h.index = r, h.first = 0 === r, h.last = !!a, l && (h.contextPath = l + e)), c += s(t[e], {
                        data: h,
                        blockParams: i.blockParams([t[e], e], [l + e, null])
                    })
                }
                if (!e) throw new n["default"]("Must pass iterator to #each");
                var s = e.fn,
                    a = e.inverse,
                    o = 0,
                    c = "",
                    h = void 0,
                    l = void 0;
                if (e.data && e.ids && (l = i.appendContextPath(e.data.contextPath, e.ids[0]) + "."), i.isFunction(t) && (t = t.call(this)), e.data && (h = i.createFrame(e.data)), t && "object" == typeof t)
                    if (i.isArray(t))
                        for (var p = t.length; p > o; o++) o in t && r(o, o, o === t.length - 1);
                    else {
                        var u = void 0;
                        for (var f in t) t.hasOwnProperty(f) && (void 0 !== u && r(u, o - 1), u = f, o++);
                        void 0 !== u && r(u, o - 1, !0)
                    }
                return 0 === o && (c = a(this)), c
            })
        }, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";
        var s = r(8)["default"];
        e.__esModule = !0;
        var i = r(12),
            a = s(i);
        e["default"] = function(t) {
            t.registerHelper("helperMissing", function() {
                if (1 !== arguments.length) throw new a["default"]('Missing helper: "' + arguments[arguments.length - 1].name + '"')
            })
        }, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";
        e.__esModule = !0;
        var s = r(13);
        e["default"] = function(t) {
            t.registerHelper("if", function(t, e) {
                return s.isFunction(t) && (t = t.call(this)), !e.hash.includeZero && !t || s.isEmpty(t) ? e.inverse(this) : e.fn(this)
            }), t.registerHelper("unless", function(e, r) {
                return t.helpers["if"].call(this, e, {
                    fn: r.inverse,
                    inverse: r.fn,
                    hash: r.hash
                })
            })
        }, t.exports = e["default"]
    }, function(t, e) {
        "use strict";
        e.__esModule = !0, e["default"] = function(t) {
            t.registerHelper("log", function() {
                for (var e = [void 0], r = arguments[arguments.length - 1], s = 0; s < arguments.length - 1; s++) e.push(arguments[s]);
                var i = 1;
                null != r.hash.level ? i = r.hash.level : r.data && null != r.data.level && (i = r.data.level), e[0] = i, t.log.apply(t, e)
            })
        }, t.exports = e["default"]
    }, function(t, e) {
        "use strict";
        e.__esModule = !0, e["default"] = function(t) {
            t.registerHelper("lookup", function(t, e) {
                return t && t[e]
            })
        }, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";
        e.__esModule = !0;
        var s = r(13);
        e["default"] = function(t) {
            t.registerHelper("with", function(t, e) {
                s.isFunction(t) && (t = t.call(this));
                var r = e.fn;
                if (s.isEmpty(t)) return e.inverse(this);
                var i = e.data;
                return e.data && e.ids && (i = s.createFrame(e.data), i.contextPath = s.appendContextPath(e.data.contextPath, e.ids[0])), r(t, {
                    data: i,
                    blockParams: s.blockParams([t], [i && i.contextPath])
                })
            })
        }, t.exports = e["default"]
    }, function(t, e, r) {
        "use strict";
        e.__esModule = !0;
        var s = r(13);
        e["default"] = function(t) {
            t.registerDecorator("inline", function(t, e, r, i) {
                var a = t;
                return e.partials || (e.partials = {}, a = function(i, a) {
                    var n = r.partials;
                    r.partials = s.extend({}, n, e.partials);
                    var o = t(i, a);
                    return r.partials = n, o
                }), e.partials[i.args[0]] = i.fn, a
            })
        }, t.exports = e["default"]
    }])
});
$("body").on("click", "#header-menu-navigation-bar", function(event) {
    $("#accountMenu").removeClass("act");
    if ($("#display_type").val() == "mobile" || $("#display_type").val() == "mobile_all_page") {
        $(".navbar-collapse").toggle("fadeOut");
    } else {
        $(".navbar-collapse").toggle();
    }
    $("#js_hotel_filter_options").removeClass("on-click-render");
    $(".menu-nav-bar-up-arrow").toggle();
    event.stopPropagation();
});
var after_login_events = function() {
    $("#dw-trigger").on("click", function(event) {
        event.stopPropagation();
        $("#accountMenu").toggleClass("act");
        $(".navbar-collapse").hide();
        $(".menu-nav-bar-up-arrow").hide();
    });
};
after_login_events();
document.addEventListener("click", function(e) {
    $("#accountMenu").removeClass("act");
    $(".navbar-collapse").hide();
    $(".menu-nav-bar-up-arrow").hide();
    $(".tooltip-inside-content").hide();
    if (typeof itineraryGroupPlanning != "undefined" && $(e.target).attr("id") == "js_group_planning_container") {
        itineraryGroupPlanning.closeGroupPlanning();
    }
    if ($("#display_type").val() == "mobile" || $("#display_type").val() == "mobile_all_page") {
        if (typeof itinerary_activity_controller !== "undefined") {
            if (itinerary_activity_controller.process_bubbled_event) {
                $("body").removeAttr("style");
                itinerary_activity_controller.touch_event_running = false;
                $("#js_iti_day_places_list li").removeClass("block-ready-to-move");
                if ($(".sortable").hasClass("ui-sortable")) {
                    $(".sortable").sortable("disable");
                }
            } else {
                itinerary_activity_controller.process_bubbled_event = true;
            }
        }
        $(".attraction-error-tooltip").css({
            opacity: 0,
            visibility: "hidden"
        });
    }
});
_data_found = false;
$(document).click(function(e) {
    if ($("#js-suggestions ul li").length) {
        if ($("#js-suggestions").has(e.target).length === 0 && e.target != $("html").get(0)) {
            $("#js-suggestions ul").children().remove();
            $("#js-suggestions").css("display", "none");
            $("#js-suggestions").scrollTop(0);
        }
    }
    if ($(e.target).closest("#js-google-place-images").length <= 0 && !$(e.target).hasClass("js-htl-search-icn")) {
        $("#js-google-place-images #js-image-list").html("");
    }
});

function removeCity(str1, str2) {
    $(".search-place-name").parent().remove();
    window.location.href = "/places";
}
$(document).ready(function() {
    if (typeof String.prototype.trim !== "function") {
        String.prototype.trim = function() {
            return this.replace(/^\s+|\s+$/g, "");
        };
    }
    window.AutoComplete = function(opts) {
        var self = this;
        this.suggestionItemTemplate = $("#suggestion-template").html();
        this.selectedItemTemplate = $("#selected-item-template").html();
        this.targetSearchInput = $("#js-spl-autocomplete-form #spl-autocomplete-search");
        this.listContainer = $("#js-suggestions ul");
        this.selectedItemContainer = $("#selected-item-container");
        this.criteria = this.targetSearchInput.data("criteria");
        this.selectedData = this.targetSearchInput.data("selectedRecords");
        this.selectedRecordForSearch = {};
        this.searchForm = $("#js-spl-autocomplete-form");
        this.requests = false;
        if (opts) {
            $.extend(this, opts);
        }
        this.not_allowed_types = ["locality", "country", "neighbourhood", "administrative_area_level_1"];
        if (self.criteria && self.criteria.showSelectedItem == undefined) {
            self.criteria.showSelectedItem = true;
        }
        this.renderListItem = function(template, data) {
            var htmlTemplate = template;
            var template = Handlebars.compile(htmlTemplate);
            var renderHtml = template(data);
            return renderHtml;
        };
        if (this.selectedData) {
            self.selectedItemContainer.empty();
            var data = {};
            data.results = this.selectedData;
            for (var i = 0; i < data.results.length; i++) {
                try {
                    if (self.criteria.inCase == "place_search_home") {
                        self.listContainer.html("");
                        $("#spl-autocomplete-search").html(data.results[i].name);
                        self.targetSearchInput.val(data.results[i].name);
                        $("#placeType").val(data.results[i].type);
                        $("#placeId").val(data.results[i].objectId);
                    }
                } catch (e) {}
                data.results[i]["record"] = JSON.stringify(data.results[i]);
                data.results[i]["record"] = data.results[i]["record"].replace(new RegExp("\\b'\\b", "gi"), "`");
                var html = self.renderListItem(self.selectedItemTemplate, data.results[i]);
                self.selectedItemContainer.append(html);
            }
        }
        this.selectItem = function(item, container, template) {
            var selectedItem = $(item).data("record");
            this.selectedRecordForSearch = $(item).data("record");
            self.listContainer.html("");
            self.targetSearchInput.val("");
            self.listContainer.removeClass("js-suggestions-active");
            if (self.criteria.limit) {
                if ((self.selectedItemContainer.find("input[type=hidden]").length / 2) >= self.criteria.limit && self.criteria.limit > 1) {
                    term = "terms";
                    if (self.criteria.title != undefined) {
                        term = self.criteria.title;
                    }
                    alert("You cannot add more than " + self.criteria.limit + " " + term + "");
                    return false;
                }
            }
            try {
                if (self.criteria.inCase == "place_search_home") {
                    $("#spl-autocomplete-search").html(this.selectedRecordForSearch.name);
                    self.targetSearchInput.val(this.selectedRecordForSearch.name);
                    $("#placeType").val(this.selectedRecordForSearch.type);
                    $("#placeId").val(this.selectedRecordForSearch.objectId);
                    $("#spl-autocomplete-search").data("selected_item", selectedItem);
                    $("#js-suggestions").css("display", "none");
                    if (selectedItem.type == "city" && typeof bookingPopunder != "undefined" && joguru.device_type === "web") {
                        bookingPopunder.homePageAutoSelect({
                            id: selectedItem.id,
                            type: selectedItem.type,
                            page_name: self.criteria.pageName
                        });
                    }
                } else {
                    if (self.criteria.inCase == "place_search_hotel") {
                        $("#spl-autocomplete-search").html(this.selectedRecordForSearch.name);
                        self.targetSearchInput.val(this.selectedRecordForSearch.name);
                        $("#placeType").val(this.selectedRecordForSearch.type);
                        $("#placeId").val(this.selectedRecordForSearch.id);
                        $("#js-suggestions").css("display", "none");
                    }
                }
            } catch (e) {}
            try {
                if (self.criteria.inCase == "city_search_blog" || self.criteria.inCase == "city_search_adda_page" || self.criteria.inCase == "city_search_bottom_RHS" || self.criteria.inCase == "city_search_city_page") {
                    $("#placeType").val(this.selectedRecordForSearch.type);
                    $("#placeId").val(this.selectedRecordForSearch.id);
                    $("#placeName").val(this.selectedRecordForSearch.name);
                    $("#placeDsc").val(this.selectedRecordForSearch.dsc);
                    $("#update_city_name").text(this.selectedRecordForSearch.name);
                    updateBlogSearchUrls();
                }
            } catch (e) {}
            if (self.criteria.limit == 1) {
                self.selectedItemContainer.html("");
            }
            if (self.criteria.inCase != undefined && self.criteria.inCase == "home_search") {
                $("#spl-autocomplete-search").val(selectedItem.name);
                $("#spl-autocomplete-search").addClass("select-city-txt");
                var _temp_srchType = (typeof selectedItem.type != "undefined") ? selectedItem.type : "";
                var _monitor = {};
                _monitor.text = "homepage-autocomple-select:" + _temp_srchType + ":" + selectedItem.name;
                _monitor.page = "homepage-itinerary-create";
                add_monitor_record(_monitor);
                $("#plan-my-trip").attr("href", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id);
                $("#iti_step1_search_form").attr("action", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id);
                switch (selectedItem.type) {
                    case "city":
                        if (joguru.device_type === "web" && typeof bookingPopunder != "undefined") {
                            bookingPopunder.homePageAutoSelect({
                                id: selectedItem.id,
                                type: selectedItem.type,
                                page_name: self.criteria.pageName
                            });
                        }
                        $("#plan-my-trip").data("city_id", selectedItem.id);
                        $("#plan-my-trip").data("selected_item", selectedItem);
                        setTimeout(function() {
                            $.get(joguru.base + "itinerary_ajax/get_url/itinearary-city/" + selectedItem.id, function(response, status) {
                                if ("url" in response && response.url) {
                                    $("#plan-my-trip").attr("href", response.url);
                                    $("#iti_step1_search_form").attr("action", response.url);
                                } else {
                                    $("#plan-my-trip").attr("href", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id);
                                    $("#iti_step1_search_form").attr("action", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id);
                                }
                            });
                        }, 50);
                        break;
                    case "country":
                        $.get(joguru.base + "itinerary_ajax/get_url/itinerary-country/" + selectedItem.id, function(response, status) {
                            if ("url" in response && response.url) {
                                $("#plan-my-trip").attr("href", response.url);
                                $("#iti_step1_search_form").attr("action", response.url);
                            } else {
                                $("#plan-my-trip").attr("href", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id);
                                $("#iti_step1_search_form").attr("action", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id);
                            }
                        });
                        break;
                    default:
                        $("#plan-my-trip").attr("href", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id);
                        $("#iti_step1_search_form").attr("action", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id);
                }
                return false;
            }
            if (self.criteria.inCase != undefined && self.criteria.inCase == "blog_post_trip_search") {
                $("#spl-autocomplete-search").val(selectedItem.name);
                $("#spl-autocomplete-search").addClass("select-city-txt");
                var utm_key = "utm_source=" + self.criteria.utm_source + "&utm_campaign=" + self.criteria.utm_campaign + "&utm_medium=" + self.criteria.utm_medium + "&utm_click=" + self.criteria.utm_click;
                $("#plan-my-trip").attr("href", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id + "&" + utm_key);
                switch (selectedItem.type) {
                    case "city":
                        $.get(joguru.base + "itinerary_ajax/get_url/itinearary-city/" + selectedItem.id, function(response, status) {
                            if ("url" in response && response.url) {
                                var create_trip_url = response.url + "?" + utm_key;
                                $("#plan-my-trip").attr("href", create_trip_url);
                            } else {
                                $("#plan-my-trip").attr("href", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id + "&" + utm_key);
                            }
                        });
                        break;
                    case "country":
                        $.get(joguru.base + "itinerary_ajax/get_url/itinerary-country/" + selectedItem.id, function(response, status) {
                            if ("url" in response && response.url) {
                                var create_trip_url = response.url + "?" + utm_key;
                                $("#plan-my-trip").attr("href", create_trip_url);
                            } else {
                                $("#plan-my-trip").attr("href", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id + "&" + utm_key);
                            }
                        });
                        break;
                    default:
                        $("#plan-my-trip").attr("href", joguru.base + "tripplanner?" + selectedItem.type + "_id=" + selectedItem.id + "&" + utm_key);
                }
                return false;
            }
            if (self.criteria.inCase != undefined && self.criteria.inCase == "bookingHotelSearch") {
                itinerary_hotel_controller.getHotelById(selectedItem);
                return false;
            }
            if (self.criteria.inCase != undefined && self.criteria.inCase == "adda_search") {
                this.base_url = "/search/getAddaDetails/" + selectedItem.id;
                $.ajax({
                    url: this.base_url,
                    success: function(data) {
                        window.location.replace(data);
                    }
                });
                return false;
            }
            if (self.criteria.inCase != undefined && self.criteria.inCase == "google_search") {
                selectedItem = JSON.parse(unescape(selectedItem));
                self.targetSearchInput.val(selectedItem.description);
                self.listContainer.parent().hide();
                if (self.criteria.inCase != undefined && self.criteria.inCase == "google_search") {
                    self.targetSearchInput.data("q", self.targetSearchInput.val());
                    GooglePlaceSearch.listResultsNew({
                        data: selectedItem
                    });
                }
                return false;
            }
            if (self.criteria.inCase != undefined && self.criteria.inCase == "google_hotel_search") {
                if (selectedItem.source == "triphobo") {
                    itinerary_hotel_controller.getHotelById(selectedItem);
                    return false;
                }
                selectedItem = JSON.parse(unescape(selectedItem));
                self.targetSearchInput.val(selectedItem.description);
                if (self.criteria.inCase != undefined && self.criteria.inCase == "google_hotel_search") {
                    self.targetSearchInput.data("q", self.targetSearchInput.val());
                    GoogleHotelSearch.listResultsNew({
                        data: selectedItem
                    });
                }
                return false;
            }
            if (self.criteria.inCase != undefined && self.criteria.inCase == "create_itinerary") {
                selectedItem.value = selectedItem.id;
                selectedItem.place = selectedItem.name;
                var _temp_autoComplete = "";
                if ($(".master-search").is(":visible")) {
                    _temp_autoComplete = "new_ui_";
                }
                switch (selectedItem.type) {
                    case "country":
                        Handlebars.registerPartial("setMoreCities", $("#set-more-suggest-cities").html());
                        if ("planner_master_search_view" in itinerary_app) {
                            itinerary_app.planner_master_search_view.remove();
                        }
                        if (typeof self.criteria.device_type != "undefined" && self.criteria.device_type == "mobile") {
                            var city_collection_view = new ItineraryApp.StepI.CityCollectionView();
                            city_collection_view.showCitiesOfCountry(selectedItem);
                        } else {
                            itineraryCreateController.showCitiesOfCountry(selectedItem);
                        }
                        return false;
                        break;
                    case "state":
                        Handlebars.registerPartial("setMoreCities", $("#set-more-suggest-cities").html());
                        if ("planner_master_search_view" in itinerary_app) {
                            itinerary_app.planner_master_search_view.remove();
                        }
                        if (typeof self.criteria.device_type != "undefined" && self.criteria.device_type == "mobile") {
                            var city_collection_view = new ItineraryApp.StepI.CityCollectionView();
                            city_collection_view.showCitiesOfState(selectedItem);
                        } else {
                            itineraryCreateController.showCitiesOfState(selectedItem);
                        }
                        return false;
                        break;
                    case "city":
                        if ($(".sugg-box-wrapper").length) {
                            $(".sugg-box-wrapper").css("display", "none");
                        }
                        if (joguru.device_type == "mobile" || joguru.device_type == "mobile_all_page") {
                            showOrReplaceLoaderMsg({
                                loading_text: "Adding city to the planner",
                                delay: 100
                            });
                        }
                        if ("planner_master_search_view" in itinerary_app) {
                            itinerary_app.planner_master_search_view.remove();
                        }
                        var travel_city_collection = itinerary_app.city_planner_model.get("travelCities");
                        travel_city_model = new ItineraryApp.StepI.TravelCityModel({
                            id: selectedItem.id
                        });
                        travel_city_collection.add(travel_city_model);
                        var return_city_model = itinerary_app.city_planner_model.get("returnCity");
                        travel_city_model.fetch();
                        if (itinerary_app.city_planner_model.itineraryMode == "edit") {
                            itinerary_app.city_planner_model.isAnyUpdateByUser = 1;
                        }
                        return false;
                        break;
                }
                try {
                    introguide.exit();
                } catch (e) {}
                return;
            }
            if (self.criteria.inCase != undefined && self.criteria.inCase == "from_city") {
                var from_city_model = itinerary_app.city_planner_model.get("fromCity");
                from_city_model.set("id", selectedItem.id);
                from_city_model.fetch({
                    wait: true
                });
                from_city_view = new ItineraryApp.StepI.FromCityView({
                    el: "#from-city-box",
                    model: from_city_model
                });
                from_city_view.replaceCityWithModel();
                if (itinerary_app.city_planner_model.itineraryMode == "edit") {
                    itinerary_app.city_planner_model.isAnyUpdateByUser = 1;
                }
                var _monitor = {};
                _monitor.text = _temp_autoComplete + "autcomplete-from-city-selected:" + selectedItem.name + ":city";
                _monitor.page = "step-01-itinerary-create";
                _monitor.itineraryId = $("#js_itinerary_step_first_container").data("itineraryId");
                add_monitor_record(_monitor);
                return false;
            }
            if (self.criteria.showSelectedItem) {
                var preparedHtml = self.renderListItem(self.selectedItemTemplate, selectedItem);
                self.selectedItemContainer.append(preparedHtml);
                if (self.criteria.reload && self.criteria.resultOnSelect) {
                    self.selectedItemContainer.find(".btn-default").last().hide();
                    if (!$("span.long-loading").length) {
                        self.selectedItemContainer.append('<span class="long-loading"></span>');
                    }
                }
            } else {
                self.targetSearchInput.val(selectedItem.name);
                self.targetSearchInput.data("q", selectedItem.name);
            }
            self.targetSearchInput.data("type", selectedItem.type);
            if (self.criteria.resultOnSelect) {
                self.searchForm.submit();
            }
        };
        this.suggestList = function(elem) {
            cityName = self.targetSearchInput.val().trim();
            if (cityName.length < 2) {
                if ($("#js-suggestions").css("display") != "none") {
                    $("#js-suggestions").css("display", "none");
                }
                return false;
            } else {
                $("#plan-my-trip").attr("href", joguru.base + "tripplanner?going-to=" + cityName);
            }
            if (cityName.length > 1 && joguru.device_type === "web") {
                var page_name = "";
                if (("pageName" in self.criteria) && self.criteria.pageName) {
                    page_name = self.criteria.pageName;
                }
                var not_allowed_country_arr = ["US"];
                var booking_page_name_arr = ["create_your_itinerary", "home", "hotel_home"];
                var allowed_country_arr_index_of = not_allowed_country_arr.indexOf(getCookie("country_code_by_ip"));
                var booking_page_name_arr_index_of = booking_page_name_arr.indexOf(page_name);
                if ((allowed_country_arr_index_of != -1) && (booking_page_name_arr_index_of != -1)) {
                    $(".js_best_vacation_deals").show("slow");
                }
            }
            var send_data = {
                q: cityName
            };
            if ($(".master-search").is(":visible") && self.criteria.inCase == "create_itinerary") {
                send_data._frm_autoComplete = "new_ui_";
            } else {
                if (self.criteria.inCase == "bookingHotelSearch") {
                    var send_data = {
                        q: cityName,
                        lat: self.criteria.lon_lat[1],
                        lon: self.criteria.lon_lat[0]
                    };
                }
            }
            if (cityName) {
                if (typeof(typingTimer) != "undefined") {
                    clearTimeout(typingTimer);
                }
                typingTimer = setTimeout(function() {
                    if (self.requests && self.readyState != 4) {
                        self.requests.abort();
                    }
                    if ("jsonp" in self.criteria && self.criteria.jsonp) {
                        autocomplete_url = joguru.js_base.substr(0, joguru.js_base.length - 1) + self.criteria.autocomplete_url;
                        send_data.cache = joguru.autocomplete_cache;
                        var a_options = {
                            type: "GET",
                            url: autocomplete_url,
                            cache: true,
                            data: send_data,
                            dataType: "jsonp",
                            jsonpCallback: "callbackp",
                            beforeSend: function() {
                                $("#js-suggestions").show();
                                self.listContainer.empty();
                                self.listContainer.html("<li class='auto-suggest-loading' id='js-auto-suggest-loading'><i class='fa fa-spinner fa-spin'></i></li>");
                                $("#js-auto-suggest-loading").show();
                            }
                        };
                    } else {
                        autocomplete_url = joguru.base.substr(0, joguru.base.length - 1) + self.criteria.autocomplete_url;
                        var a_options = {
                            type: "GET",
                            url: autocomplete_url,
                            data: send_data,
                            dataType: "json",
                            beforeSend: function() {
                                $("#js-suggestions").show();
                                self.listContainer.empty();
                                self.listContainer.html("<li class='auto-suggest-loading' id='js-auto-suggest-loading'><i class='fa fa-spinner fa-spin'></i></li>");
                                $("#js-auto-suggest-loading").show();
                            }
                        };
                    }
                    self.requests = $.ajax(a_options).done(function(data) {
                        try {
                            itinerary_app.city_planner_model.get("returnCity").view.closeBox({
                                action: ""
                            });
                        } catch (e) {}
                        $("#js-auto-suggest-loading").hide();
                        if ($("#js-suggestions").css("display") == "none") {
                            $("#js-suggestions").css("display", "block");
                        }
                        $("#js-suggestions").scrollTop(0);
                        self.targetSearchInput.trigger("listSuggested");
                        self.listContainer.html("");
                        self.listContainer.css("width", self.targetSearchInput.innerWidth());
                        self.listContainer.addClass("js-suggestions-active places-search-list");
                        var _temp_dataSet = data.results;
                        if (Object.keys(_temp_dataSet).length) {
                            self.listContainer.find("#js-auto-suggest-loading").remove();
                            if (self.criteria.inCase != "place_search_home" && self.criteria.inCase != "bookingHotelSearch" && self.criteria.inCase != "place_search_hotel" && self.criteria.inCase != "city_search_blog") {
                                $.each(_temp_dataSet, function(i, item) {
                                    var currType = i;
                                    if (currType != "adda") {
                                        var html = '<li class="autosuggest-head"><strong>' + currType + "</strong></li>";
                                        self.listContainer.append(html);
                                    }
                                    for (var i = 0; i < item.length; i++) {
                                        item[i]["record"] = JSON.stringify(item[i]);
                                        item[i]["record"] = item[i]["record"].replace(new RegExp("\\b'\\b", "gi"), "`");
                                        var html = self.renderListItem(self.suggestionItemTemplate, item[i]);
                                        self.listContainer.append(html);
                                    }
                                });
                            } else {
                                if (self.criteria.inCase == "place_search_hotel") {
                                    for (var i = 0; i < _temp_dataSet.City.length; i++) {
                                        _temp_dataSet.City[i]["record"] = JSON.stringify(_temp_dataSet.City[i]);
                                        _temp_dataSet.City[i]["record"] = _temp_dataSet.City[i]["record"].replace(new RegExp("\\b'\\b", "gi"), "`");
                                        var html = self.renderListItem(self.suggestionItemTemplate, _temp_dataSet.City[i]);
                                        self.listContainer.append(html);
                                    }
                                } else {
                                    for (var i = 0; i < _temp_dataSet.length; i++) {
                                        _temp_dataSet[i]["record"] = JSON.stringify(_temp_dataSet[i]);
                                        _temp_dataSet[i]["record"] = _temp_dataSet[i]["record"].replace(new RegExp("\\b'\\b", "gi"), "`");
                                        var html = self.renderListItem(self.suggestionItemTemplate, _temp_dataSet[i]);
                                        self.listContainer.append(html);
                                    }
                                }
                            }
                        } else {
                            if (self.criteria.default_no_found_msg) {
                                self.listContainer.html("<li class='error'><i>" + self.criteria.default_no_found_msg + "</i></li>");
                            } else {
                                self.listContainer.html("<li class='error'><i>No Records</i></li>");
                            }
                        }
                        if (self.criteria.inCase == "create_itinerary") {
                            _ti_pos = self.targetSearchInput.offset();
                            _ti_pos.top = _ti_pos.top + self.targetSearchInput.outerHeight();
                            $("#js-suggestions").css("position", "absolute");
                            $("#js-suggestions").css("zIndex", 999);
                            $("#js-suggestions").offset(_ti_pos);
                        }
                    });
                }, 200);
            }
        };
        this.bindKeys = function() {
            $("#spl-autocomplete-search").keydown(function(e) {
                var sugg_list = $("#js-suggestions");
                switch (e.which) {
                    case 38:
                        if (sugg_list.find("li.item").hasClass("hover")) {
                            sugg_list.find("li.hover").removeClass("hover").prev().addClass("hover");
                        } else {
                            sugg_list.find("li.item").eq((sugg_list.find("li").length) - 1).addClass("hover");
                        }
                        var sugg_list_height = $("#js-suggestions ul").height();
                        var focus_target = sugg_list.find("li.hover")[0];
                        if ($("#js-suggestions ul")[0].scrollTop > $("li.hover")[0].offsetTop) {
                            $("#js-suggestions ul")[0].scrollTop = $("li.hover")[0].offsetTop;
                        }
                        break;
                    case 40:
                        if (sugg_list.find("li.item").hasClass("hover")) {
                            sugg_list.find("li.hover").removeClass("hover").next().addClass("hover").focus();
                        } else {
                            sugg_list.find("li.item").eq(0).addClass("hover");
                        }
                        var focus_target = sugg_list.find("li.hover")[0];
                        var sugg_list_height = $("#js-suggestions ul").outerHeight();
                        $("#js-suggestions ul")[0].scrollTop = $("li.hover")[0].offsetTop - (sugg_list_height - sugg_list.find("li.hover").outerHeight());
                        break;
                    default:
                        return;
                }
                e.preventDefault();
            });
        };
        this.removeItem = function(elem) {
            $(elem).parent("div").remove();
            if (self.criteria.reload && self.criteria.resultOnSelect) {
                if (!$("span.long-loading").length && self.selectedItemContainer.find("input[type=hidden]").length) {
                    self.selectedItemContainer.append('<span class="long-loading"></span>');
                }
            }
            if (self.criteria.resultOnSelect) {
                self.searchForm.submit();
            }
        };
        this.array_intersect = function(arr1) {
            var retArr = {},
                argl = arguments.length,
                arglm1 = argl - 1,
                k1 = "",
                arr = {},
                i = 0,
                k = "";
            arr1keys: for (k1 in arr1) {
                arrs: for (i = 1; i < argl; i++) {
                    arr = arguments[i];
                    for (k in arr) {
                        if (arr[k] === arr1[k1]) {
                            if (i === arglm1) {
                                retArr[k1] = arr1[k1];
                            }
                            continue arrs;
                        }
                    }
                    continue arr1keys;
                }
            }
            return retArr;
        };
        this._fetchOurHotels = function(elem, criteria) {
            var send_data = {
                q: $("#js-google-place-form #spl-autocomplete-search")[0].value,
                lat: criteria.lat,
                lon: criteria.lng
            };
            var a_options = {
                type: "GET",
                async: false,
                url: "/autocomplete/api/bookingHotel",
                cache: true,
                data: send_data,
                dataType: "jsonp",
                jsonpCallback: "callbackp",
                beforeSend: function() {
                    self.listContainer.parent().show();
                    self.listContainer.empty();
                    self.listContainer.html("<li class='auto-suggest-loading' id='js-auto-suggest-loading'><i class='fa fa-spinner fa-spin'></i></li>");
                    $("#js-auto-suggest-loading").show();
                }
            };
            $.ajax(a_options).done(function(data) {
                $("#js-auto-suggest-loading").hide();
                if (self.listContainer.css("display") == "none") {
                    self.listContainer.css("display", "block");
                    $(self.listContainerName).css("display", "block");
                }
                self.listContainer.scrollTop(0);
                self.listContainer.html("");
                var _temp_dataSet = data.results;
                if (Object.keys(_temp_dataSet).length) {
                    $.each(_temp_dataSet, function(i, item) {
                        var currType = i;
                        var html = '<li class="autosuggest-head"><strong>' + currType + "</strong></li>";
                        item.source = "triphobo";
                        item.record = JSON.stringify(item);
                        item.record = item.record.replace(new RegExp("\\b'\\b", "gi"), "`");
                        self.listContainer.append(self.renderListItem(self.suggestionItemTemplate, item));
                    });
                    _data_found = true;
                } else {
                    _data_found = false;
                }
            });
            return _data_found;
        };
        this.googleLookUp = function(elem, criteria) {
            if ($("#js-google-place-form #spl-autocomplete-search")[0].value.length < 3) {
                $("#js-suggestions").css("display", "");
                return false;
            }
            this.suggestionItemTemplate = $("#suggestion-template-for-google").html();
            var autocomplete = new google.maps.places.AutocompleteService();
            var request = {
                input: $("#js-google-place-form #spl-autocomplete-search")[0].value,
                bounds: new google.maps.LatLngBounds(new google.maps.LatLng(criteria.lat, criteria.lng), new google.maps.LatLng(criteria.lat, criteria.lng)),
                componentRestrictions: {
                    country: criteria.cname
                }
            };
            if (self.criteria.inCase != undefined && self.criteria.inCase == "google_hotel_search") {
                if (self._fetchOurHotels(elem, criteria)) {
                    return;
                }
                if (itinerary_hotel_combined_controller.page_name == "hotel_replace") {
                    return;
                }
            }
            autocomplete.getPlacePredictions(request, function(results) {
                if (!results) {
                    return false;
                }
                if ($("#js-suggestions").css("display") == "none") {
                    $("#js-suggestions").css("display", "block");
                }
                var count = results.length;
                self.listContainer.html("");
                var list_items = new Array();
                for (var i = 0; i < count; i++) {
                    if (Object.keys(self.array_intersect(results[i].types, joguru.allowed_types)).length) {
                        results[i]["record"] = escape(JSON.stringify(results[i]));
                        results[i]["name"] = results[i]["description"];
                        if (results[i].types.indexOf("locality") < 0) {
                            var html = self.renderListItem(self.suggestionItemTemplate, results[i]);
                            self.listContainer.append(html);
                        }
                    }
                }
            });
        };
        this._bindActions = function() {
            $(document).off("mouseenter", "#js-suggestions li.item").on("mouseenter", "#js-suggestions li.item", function() {
                $("#js-suggestions li.item").removeClass("hover");
                $(this).addClass("hover");
            });
            self.targetSearchInput.on("keydown", function(e) {
                var sugg_list = $("#js-suggestions");
                if (e.which == 13) {
                    sugg_list.find("li.hover").click();
                    return false;
                } else {
                    if (e.which == 8 || e.which == 46) {
                        var _temp_cityName = self.targetSearchInput.val().trim();
                        if (_temp_cityName.length <= 1) {
                            $("#js-suggestions").hide();
                            $("#js-auto-suggest-loading").hide();
                            $("#js-suggestions ul").empty();
                        }
                    }
                }
            });
            var last_event_time = new Date().getTime();
            $(document).off("keyup", self.targetSearchInput.selector).on("keyup", self.targetSearchInput.selector, function(e) {});
            $(document).off("keyup", self.targetSearchInput.selector).on("keyup", self.targetSearchInput.selector, function(e) {
                if (e.which == 38 || e.which == 40) {
                    return false;
                }
                if (self.criteria.inCase != undefined && self.criteria.inCase == "home_search" || self.criteria.inCase == "blog_post_trip_search") {
                    $("#spl-autocomplete-search").removeClass("select-city-txt");
                }
                if (!$(this).val().length) {
                    return false;
                }
                var criteria = self.criteria;
                switch (criteria.inCase) {
                    case "google_search":
                    case "google_hotel_search":
                        self.googleLookUp(this, criteria);
                        break;
                    default:
                        self.suggestList(this);
                }
            });
            $(document).off("click", "#js-suggestions ul li.item").on("click", "#js-suggestions ul li.item", function() {
                self.selectItem(this);
            });
            $(document).off("click", "#google_place_autocomplete_form ul li.google-item").on("click", "#google_place_autocomplete_form ul li.google-item", function() {
                spl_autocomplete.criteria = $("#google_place_autocomplete_form #spl-autocomplete-search").data("criteria");
                spl_autocomplete.targetSearchInput = $("#google_place_autocomplete_form #spl-autocomplete-search");
                self.selectItem(this);
            });
            $(document).off("click", "#js_hotel_step_search_list_cont google-item").on("click", "#js_hotel_step_search_list_cont google-item", function() {
                spl_autocomplete.criteria = $("#google_place_autocomplete_form #spl-autocomplete-search").data("criteria");
                spl_autocomplete.targetSearchInput = $("#google_place_autocomplete_form #spl-autocomplete-search");
                self.selectItem(this);
            });
            $(document).off("click", "#js-suggestions1 span").on("click", "#js-suggestions1 span", function() {
                self.selectItem(this);
            });
            $(document).off("click", "div span.remove-item").on("click", "div span.remove-item", function() {
                self.removeItem(this);
            });
            $(document).off("submit", self.searchForm.selector).on("submit", self.searchForm.selector, function() {
                var criteria = self.criteria;
                if (criteria.inCase != undefined && criteria.inCase == "google_search") {
                    if (!self.targetSearchInput.val().length) {
                        return false;
                    }
                    spl_autocomplete.criteria = $("#google_place_autocomplete_form #spl-autocomplete-search").data("criteria");
                    spl_autocomplete.targetSearchInput = $("#google_place_autocomplete_form #spl-autocomplete-search");
                    self.targetSearchInput.data("q", self.targetSearchInput.val());
                    GooglePlaceSearch.listResultsNew();
                    return false;
                }
                if (criteria.inCase != undefined && criteria.inCase == "google_hotel_search") {
                    $("#js-google-place-message").find(".error").text("");
                    if (!self.targetSearchInput.val().length) {
                        $("#js-google-place-message").find(".error").text("Enter " + self.targetSearchInput.data("title"));
                        return false;
                    }
                    spl_autocomplete.criteria = $("#google_place_autocomplete_form #spl-autocomplete-search").data("criteria");
                    spl_autocomplete.targetSearchInput = $("#google_place_autocomplete_form #spl-autocomplete-search");
                    self.targetSearchInput.data("q", self.targetSearchInput.val());
                    GoogleHotelSearch.listResultsNew();
                    return false;
                }
                if (typeof criteria.resultOnSelect != "undefined" && !criteria.resultOnSelect) {
                    if (!self.selectedItemContainer.find("input[type=hidden]").length) {
                        alert("Enter " + self.targetSearchInput.data("title"));
                        return false;
                    }
                }
                var input_fields = $(this).find(".remove-input");
                var input_fields_values = [];
                for (i = 0; i < input_fields.length; i++) {
                    if (criteria.inCase != undefined && criteria.inCase == "itinerarySearch") {
                        input_fields_values[i] = input_fields[i].value.split(" ").join("-");
                    } else {
                        input_fields_values[i] = input_fields[i].value;
                    }
                }
                if (input_fields_values) {
                    input_fields_values = input_fields_values.join(",");
                }
                var new_action = this.action + "/" + input_fields_values;
                if (self.criteria.reload) {
                    if (!self.selectedItemContainer.find("input[type=hidden]").length) {
                        if (self.criteria.finalRedirect) {
                            new_action = self.criteria.finalRedirect;
                        } else {
                            return false;
                        }
                    }
                }
                if (self.targetSearchInput.data("type") && ("country" == self.targetSearchInput.data("type"))) {
                    type = self.targetSearchInput.data("type");
                    new_action += "/?type=" + type;
                }
                if (!criteria.reload) {
                    $.ajax({
                        type: "POST",
                        url: new_action
                    }).done(function(data) {
                        if (criteria.inCase == "place_search") {
                            try {
                                data = JSON.parse(data);
                                $(".show-more-btn").show();
                                $(".places-specific-search-results-wrapper").append().html("");
                                if (data.html) {
                                    $(".places-specific-search-results-wrapper").append(data.html);
                                }
                                if (type == "country") {
                                    $(".places-default-results-wrapper").hide();
                                }
                                if ($(".places-specific-search-results-wrapper").find(".js-block-list-item").length < 12) {
                                    $(".places-specific-search-results-wrapper").find(".show-more-btn").hide();
                                }
                            } catch (e) {}
                        } else {
                            try {
                                data = JSON.parse(data);
                                $("#Ajaxsearch").html(data.html);
                                if (data.show_visit_wish_block) {
                                    visit_wish_block();
                                }
                            } catch (e) {}
                        }
                    });
                    return false;
                } else {
                    this.action = new_action;
                    $(".remove-input").remove();
                    return true;
                }
            });
        };
        this.initialize = function() {
            this.bindKeys();
            this._bindActions();
        };
    };
    window.spl_autocomplete = new AutoComplete();
    spl_autocomplete.initialize();
});
! function(t) {
    t.fn.unveil = function(i, e) {
        function n() {
            var i = a.filter(function() {
                var i = t(this);
                if (!i.is(":hidden")) {
                    var e = o.scrollTop(),
                        n = e + o.height(),
                        r = i.offset().top,
                        s = r + i.height();
                    return s >= e - u && n + u >= r
                }
            });
            r = i.trigger("unveil"), a = a.not(r)
        }
        var r, o = t(window),
            u = i || 0,
            s = window.devicePixelRatio > 1,
            l = s ? "data-src-retina" : "data-src",
            a = this;
        return this.one("unveil", function() {
            var t = this.getAttribute(l);
            t = t || this.getAttribute("data-src"), t && (this.setAttribute("src", t), "function" == typeof e && e.call(this))
        }), o.on("scroll.unveil resize.unveil lookup.unveil", n), n(), this
    }
}(window.jQuery || window.Zepto);

function initNotification() {
    try {
        clearMessages();
        var e = getBrowserInfo();
        "default" == Notification.permission && null == getCookie("remindNotifyLater") && "safari" != e.browserType && $(".push-popup.mobile-only").fadeIn(1e3, function() {
            analyticEventTracking({
                _category: "push_notify_popup",
                _page_name: "popup-open",
                _value: 1
            })
        }), "safari" == e.browserType && analyticEventTracking({
            _category: "push_notify_popup",
            _page_name: "browser_NA",
            _value: e.browserType
        })
    } catch (n) {
        requestPermission()
    }
}

function sendTokenToServer(e) {
    if (!isTokenSentToServer()) {
        var n = "";
        "undefined" != typeof joguru.author_id && "" != joguru.author_id && (n = joguru.author_id);
        var o = "";
        "undefined" != typeof joguru.session_id && (o = joguru.session_id);
        var i = {
                ept: e,
                dv: getBrowserInfo(),
                uid: n,
                pf: joguru.device_type,
                sid: o,
                tm: new Date,
                pg: window.location.href
            },
            t = $.ajax({
                url: joguru.base + "notification/notifyme",
                type: "post",
                data: i,
                dataType: "json",
                success: function(e) {
                    e.success && e.isNotify && (payload = e.payload, showNotification(payload))
                },
                error: function() {}
            });
        t.fail(function() {})
    }
}

function isTokenSentToServer() {
    return 1 == window.localStorage.getItem("sentToServer")
}

function setTokenSentToServer(e) {
    window.localStorage.setItem("sentToServer", e ? 1 : 0), delete_cookie("remindNotifyLater")
}

function remindNotifyLater() {
    createCookie("remindNotifyLater", 1, 48), $(".push-popup.mobile-only").hide(1e3), analyticEventTracking({
        _category: "push_notify_popup",
        _page_name: "remind_later",
        _value: 1
    })
}

function requestPermission() {
    $(".push-popup.mobile-only").hide(300), analyticEventTracking({
        _category: "push_notify_popup",
        _page_name: "allow",
        _value: 1
    }), messaging.requestPermission().then(function() {
        messaging.getToken().then(function(e) {
            try {
                e ? (setTokenSentToServer(!1), sendTokenToServer(e)) : setTokenSentToServer(!1), analyticEventTracking({
                    _category: "push_notify_popup",
                    _page_name: "permission_granted",
                    _value: e
                })
            } catch (n) {}
        })["catch"](function(e) {
            setTokenSentToServer(!1), analyticEventTracking({
                _category: "push_notify_popup",
                _page_name: "permission_error",
                _value: e
            })
        })
    })["catch"](function() {
        analyticEventTracking({
            _category: "push_notify_popup",
            _page_name: "permission_failed",
            _value: Notification.permission
        })
    })
}

function deleteToken() {
    messaging.getToken().then(function(e) {
        messaging.deleteToken(e).then(function() {
            setTokenSentToServer(!1), initNotification()
        })["catch"](function() {})
    })["catch"](function() {})
}

function appendMessage(e) {
    "granted" !== Notification.permission ? Notification.requestPermission() : showNotification(e)
}

function clearMessages() {
    try {
        for (var e = document.querySelector("#messages"); e.hasChildNodes();) e.removeChild(e.lastChild)
    } catch (n) {}
}

function showNotification(e) {
    var n = new Notification(e.notification.title, {
        icon: e.notification.icon,
        body: e.notification.body
    });
    n.onclick = function() {
        parent.focus(), window.focus(), this.close()
    }, analyticEventTracking({
        _category: "push_notify_popup",
        _page_name: "notification_show",
        _value: 1
    })
}

function getBrowserInfo() {
    var e = {};
    return -1 != (navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf("OPR")) ? e.browserType = "opera" : -1 != navigator.userAgent.indexOf("Chrome") ? e.browserType = "chrome" : -1 != navigator.userAgent.indexOf("Safari") ? e.browserType = "safari" : -1 != navigator.userAgent.indexOf("Firefox") ? e.browserType = "firefox" : -1 != navigator.userAgent.indexOf("MSIE") || 1 == !!document.documentMode ? e.browserType = "ie" : e.browserType = "_NA_", e.cookieEnabled = navigator.cookieEnabled, e.appVersion = navigator.appVersion, e.appCodeName = navigator.appCodeName, e
}
var config = {
    apiKey: joguru.notification.ckey,
    messagingSenderId: joguru.notification.sid
};
firebase.initializeApp(config);
var messaging = firebase.messaging();
messaging.onTokenRefresh(function() {
    messaging.getToken().then(function(e) {
        setTokenSentToServer(!1), sendTokenToServer(e), initNotification()
    })["catch"](function(e) {
        showToken("Unable to retrieve refreshed token ", e)
    })
}), messaging.onMessage(function(e) {
    appendMessage(e)
}), $(document).ready(function() {
    setTimeout(function() {
        initNotification()
    }, 600)
});