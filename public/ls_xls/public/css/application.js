"use strict";!function(a){var b={Constants:{CUSTOM_SCROLLBAR_DISTANCE:"4px",CUSTOM_SCROLLBAR_HEIGHT:"100%",CUSTOM_SCROLLBAR_SIZE:"7px",CUSTOM_SCROLLBAR_TOUCH_SCROLL_STEP:50,CUSTOM_SCROLLBAR_WHEEL_STEP:10,CUSTOM_SCROLLBAR_WIDTH:"100%",MEDIA_QUERY_BREAKPOINT:"992px",SELECT2_THEME:"bootstrap",SELECT2_WIDTH:"100%",SHARE_MESSAGE_EXPIRES:1,SHARE_MESSAGE_EXTENDED_TIME_OUT:5e3,SHARE_MESSAGE_KEY:"share_message",SHARE_MESSAGE_PROGRESS_BAR:!0,SHARE_MESSAGE_STATUS:!0,SHARE_MESSAGE_TIME_OUT:15e3,STICKY_OFF_RESOLUTIONS:-768,STICKY_TOP:55,TRANSITION_DELAY:400,TRANSITION_DURATION:400},CssClasses:{LAYOUT:"layout",LAYOUT_HEADER:"layout-header",LAYOUT_SIDEBAR:"layout-sidebar",LAYOUT_CONTENT:"layout-content",LAYOUT_FOOTER:"layout-footer",LAYOUT_HEADER_FIXED:"layout-header-fixed",LAYOUT_SIDEBAR_FIXED:"layout-sidebar-fixed",LAYOUT_FOOTER_FIXED:"layout-footer-fixed",LAYOUT_SIDEBAR_COLLAPSED:"layout-sidebar-collapsed",LAYOUT_SIDEBAR_STICKY:"layout-sidebar-sticky",SIDENAV:"sidenav",SIDENAV_BTN:"sidenav-toggler",SIDENAV_COLLAPSED:"sidenav-collapsed",SIDENAV_ACTIVE:"open",SIDENAV_COLLAPSE:"collapse",SIDENAV_COLLAPSE_IN:"in",SIDENAV_COLLAPSING:"collapsing",SEARCH_FORM:"navbar-search",SEARCH_FORM_BTN:"navbar-search-toggler",SEARCH_FORM_COLLAPSED:"navbar-search-collapsed",CUSTOM_SCROLLBAR:"custom-scrollbar",CUSTOM_SCROLLBAR_BAR:"custom-scrollbar-gripper",CUSTOM_SCROLLBAR_RAIL:"custom-scrollbar-track",CUSTOM_SCROLLBAR_WRAPPER:"custom-scrollable-area",STICKY:"sticky-scrollbar",STICKY_WRAPPER:"sticky-scrollable-area",THEME_PANEL:"theme-panel",THEME_PANEL_BTN:"theme-panel-toggler",THEME_PANEL_COLLAPSED:"theme-panel-collapsed",COLLAPSED:"collapsed"},KeyCodes:{S:83,OPEN_SQUARE_BRACKET:219,CLOSE_SQUARE_BRACKET:221},init:function(){this.$document=a(document),this.$layout=a("."+this.CssClasses.LAYOUT),this.$header=a("."+this.CssClasses.LAYOUT_HEADER),this.$sidebar=a("."+this.CssClasses.LAYOUT_SIDEBAR),this.$content=a("."+this.CssClasses.LAYOUT_CONTENT),this.$footer=a("."+this.CssClasses.LAYOUT_FOOTER),this.$scrollableArea=a("."+this.CssClasses.CUSTOM_SCROLLBAR),this.$sidenav=a("."+this.CssClasses.SIDENAV),this.$sidenavBtn=a("."+this.CssClasses.SIDENAV_BTN),this.$searchForm=a("."+this.CssClasses.SEARCH_FORM),this.$searchFormBtn=a("."+this.CssClasses.SEARCH_FORM_BTN),this.$themePanel=a("."+this.CssClasses.THEME_PANEL),this.$themePanelBtn=a("."+this.CssClasses.THEME_PANEL_BTN),this.$themeSettings=this.$themePanel.find(":checkbox");var b="(max-width: "+this.Constants.MEDIA_QUERY_BREAKPOINT+")";this.mediaQueryList=window.matchMedia(b),this.mediaQueryMatches()&&this.collapseSidenav(),this.addCustomScrollbarTo(this.$scrollableArea),this.initPlugins().bindEvents().syncThemeSettings()},bindEvents:function(){return this.$document.on("keydown.e.app",this.handleKeyboardEvent.bind(this)),this.$sidenavBtn.on("click.e.app",this.handleSidenavToggle.bind(this)),this.$sidenav.on("collapse-start.e.app",this.handleSidenavCollapseStart.bind(this)).on("expand-start.e.app",this.handleSidenavExpandStart.bind(this)),this.$sidenav.on("collapse-end.e.app",this.handleSidebarStickyUpdate.bind(this)).on("expand-end.e.app",this.handleSidebarStickyUpdate.bind(this)),this.$sidenav.on("shown.metisMenu.e.app",this.handleSidebarStickyUpdate.bind(this)).on("hidden.metisMenu.e.app",this.handleSidebarStickyUpdate.bind(this)),this.$searchFormBtn.on("click.e.app",this.handleSearchFormToggle.bind(this)),this.$themePanelBtn.on("click.e.app",this.handleThemePanelToggle.bind(this)),this.$themeSettings.on("change.e.app",this.handleThemeSettingsChange.bind(this)),this.mediaQueryList.addListener(this.handleMediaQueryChange.bind(this)),this},handleKeyboardEvent:function(a){if(!/input|textarea/i.test(a.target.tagName))switch(a.keyCode){case this.KeyCodes.S:this.toggleSearchForm();break;case this.KeyCodes.OPEN_SQUARE_BRACKET:this.toggleSidenav();break;case this.KeyCodes.CLOSE_SQUARE_BRACKET:this.toggleThemePanel()}},handleSidenavToggle:function(a){a.preventDefault(),this.toggleSidenav()},handleSidenavCollapseStart:function(a){var b=this.getThemeSettingsBy(this.CssClasses.LAYOUT_SIDEBAR_COLLAPSED);b.prop("checked",!0)},handleSidenavExpandStart:function(a){var b=this.getThemeSettingsBy(this.CssClasses.LAYOUT_SIDEBAR_COLLAPSED);b.prop("checked",!1)},handleSidebarStickyUpdate:function(a){this.isSidebarSticky()&&this.updateStickySidebar()},handleSearchFormToggle:function(a){a.preventDefault(),this.toggleSearchForm()},handleThemePanelToggle:function(a){a.preventDefault(),this.toggleThemePanel()},handleThemeSettingsChange:function(b){var c=a(b.target);switch(c.attr("name")){case this.CssClasses.LAYOUT_HEADER_FIXED:this.setHeaderFixed(c.prop("checked"));break;case this.CssClasses.LAYOUT_SIDEBAR_FIXED:this.setSidebarFixed(c.prop("checked"));break;case this.CssClasses.LAYOUT_SIDEBAR_STICKY:this.setSidebarSticky(c.prop("checked"));break;case this.CssClasses.LAYOUT_SIDEBAR_COLLAPSED:this.$sidenavBtn.trigger("click");break;case this.CssClasses.LAYOUT_FOOTER_FIXED:this.setFooterFixed(c.prop("checked"))}},handleMediaQueryChange:function(a){this[this.mediaQueryMatches()?"collapseSidenav":"expandSidenav"]()},collapseSidenav:function(){var b=a.Event("collapse-start");this.$layout.addClass(this.CssClasses.LAYOUT_SIDEBAR_COLLAPSED),this.$sidenav.trigger(b).hide(),this.$sidenav.addClass(this.CssClasses.SIDENAV_COLLAPSED),this.$sidenavBtn.addClass(this.CssClasses.COLLAPSED),this.transitionTimeoutId&&clearTimeout(this.transitionTimeoutId),this.transitionTimeoutId=setTimeout(function(){this.$sidenav.fadeIn(this.Constants.TRANSITION_DURATION).trigger("collapse-end")}.bind(this),this.Constants.TRANSITION_DELAY),this.$sidenav.attr("aria-expanded",!1),this.$sidenavBtn.attr("aria-expanded",!1).attr("title","Expand sidenav ( [ )")},expandSidenav:function(){var b=a.Event("expand-start");this.$layout.removeClass(this.CssClasses.LAYOUT_SIDEBAR_COLLAPSED),this.$sidenav.trigger(b).hide(),this.$sidenav.removeClass(this.CssClasses.SIDENAV_COLLAPSED),this.$sidenavBtn.removeClass(this.CssClasses.COLLAPSED),this.transitionTimeoutId&&clearTimeout(this.transitionTimeoutId),this.transitionTimeoutId=setTimeout(function(){this.$sidenav.fadeIn(this.Constants.TRANSITION_DURATION).trigger("expand-end")}.bind(this),this.Constants.TRANSITION_DELAY),this.$sidenav.attr("aria-expanded",!0),this.$sidenavBtn.attr("aria-expanded",!0).attr("title","Collapse sidenav ( [ )")},toggleSidenav:function(){this[this.isSidenavCollapsed()?"expandSidenav":"collapseSidenav"]()},isSidenavCollapsed:function(){return this.$sidenav.hasClass(this.CssClasses.SIDENAV_COLLAPSED)},toggleSearchForm:function(){this.$searchForm.toggleClass(this.CssClasses.SEARCH_FORM_COLLAPSED),this.$searchFormBtn.toggleClass(this.CssClasses.COLLAPSED),this.isSearchFormCollapsed()?(this.$searchForm.attr("aria-expanded",!1),this.$searchFormBtn.attr("aria-expanded",!1).attr("title","Expand search form ( S )")):(this.$searchForm.attr("aria-expanded",!0),this.$searchFormBtn.attr("aria-expanded",!0).attr("title","Collapse search form ( S )"))},isSearchFormCollapsed:function(){return this.$searchForm.hasClass(this.CssClasses.SEARCH_FORM_COLLAPSED)},toggleThemePanel:function(){this.$themePanel.toggleClass(this.CssClasses.THEME_PANEL_COLLAPSED),this.$themePanelBtn.toggleClass(this.CssClasses.COLLAPSED),this.isThemePanelCollapsed()?(this.$themePanel.attr("aria-expanded",!1),this.$themePanelBtn.attr("aria-expanded",!1).attr("title","Expand theme panel ( ] )")):(this.$themePanel.attr("aria-expanded",!0),this.$themePanelBtn.attr("aria-expanded",!0).attr("title","Collapse theme panel ( ] )"),this.showShareMessage())},isThemePanelCollapsed:function(){return this.$themePanel.hasClass(this.CssClasses.THEME_PANEL_COLLAPSED)},syncThemeSettings:function(){var b={};return this.$themeSettings.each(function(c,d){var e=a(d),f=e.attr("name");e.data("sync")&&(b[f]=this.$layout.hasClass(f))}.bind(this)),this.changeThemeSettings(b),this},changeThemeSettings:function(b){return a.each(b,function(a,b){var c=this.getThemeSettingsBy(a);c.prop("checked",b).trigger("change")}.bind(this)),this},getThemeSettingsBy:function(a){return this.$themeSettings.filter("[name='"+a+"']")},isShareMessageShown:function(){return!!Cookies.get(this.Constants.SHARE_MESSAGE_KEY)},setShareMessageShown:function(){var a,b,c={};a=this.Constants.SHARE_MESSAGE_KEY,b=this.Constants.SHARE_MESSAGE_STATUS,c.expires=this.Constants.SHARE_MESSAGE_EXPIRES,Cookies.set(a,b,c)},showShareMessage:function(){var a,b,c;this.isShareMessageShown()||(c=this.getShareMessageOptions(),b="If you like Elephant, please share it with your friends and followers, this way you will help the elephant grow.",toastr.info(b,a,c),this.setShareMessageShown())},isHeaderStatic:function(){return!this.$layout.hasClass(this.CssClasses.LAYOUT_HEADER_FIXED)},setHeaderFixed:function(a){var b={};this.$layout.toggleClass(this.CssClasses.LAYOUT_HEADER_FIXED,a),this.isHeaderStatic()&&this.isSidebarFixed()&&(b[this.CssClasses.LAYOUT_SIDEBAR_FIXED]=a),this.isHeaderStatic()&&this.isSidebarSticky()&&(b[this.CssClasses.LAYOUT_SIDEBAR_STICKY]=a),this.changeThemeSettings(b)},isSidebarFixed:function(){return this.$layout.hasClass(this.CssClasses.LAYOUT_SIDEBAR_FIXED)},setSidebarFixed:function(a){var b={},c=this.getSidebarScrollableArea();return this.$layout.toggleClass(this.CssClasses.LAYOUT_SIDEBAR_FIXED,a),this.isSidebarFixed()?(this.isHeaderStatic()&&(b[this.CssClasses.LAYOUT_HEADER_FIXED]=a),this.isSidebarSticky()&&(b[this.CssClasses.LAYOUT_SIDEBAR_STICKY]=!a),void this.changeThemeSettings(b).addCustomScrollbarTo(c)):this.removeCustomScrollbarFrom(c)},isSidebarSticky:function(){return this.$layout.hasClass(this.CssClasses.LAYOUT_SIDEBAR_STICKY)},setSidebarSticky:function(a){var b={};return this.$layout.toggleClass(this.CssClasses.LAYOUT_SIDEBAR_STICKY,a),this.isSidebarSticky()?(this.isHeaderStatic()&&(b[this.CssClasses.LAYOUT_HEADER_FIXED]=a),this.isSidebarFixed()&&(b[this.CssClasses.LAYOUT_SIDEBAR_FIXED]=!a),void this.changeThemeSettings(b).createStickySidebar()):this.destroyStickySidebar()},setFooterFixed:function(a){this.$layout.toggleClass(this.CssClasses.LAYOUT_FOOTER_FIXED,a)},addCustomScrollbarTo:function(a){var b=this.getCustomScrollbarOptions();a.slimScroll(b)},removeCustomScrollbarFrom:function(a){var b=this.getCustomScrollbarOptions();b.destroy=!0,a.slimScroll(b).off().removeAttr("style")},createStickySidebar:function(){var a=this.getSidebarScrollableArea(),b=this.getStickyOptions();b.stickTo=this.$content,a.hcSticky(b).hcSticky("reinit")},updateStickySidebar:function(){var a=this.getSidebarScrollableArea();a.hcSticky("reinit")},destroyStickySidebar:function(){var a=this.getSidebarScrollableArea();a.data("hcSticky")&&a.hcSticky("destroy").off().removeAttr("style")},mediaQueryMatches:function(){return this.mediaQueryList.matches},getSidebarScrollableArea:function(){return this.$sidebar.find("."+this.CssClasses.CUSTOM_SCROLLBAR)},getCreateOptions:function(b, c){var d=new RegExp("^"+b+"(_)?","i"),e={};return a.each(this,function(b, f){a.isPlainObject(f)&&a.each(f,function(f, g){d.test(f)&&(f=f.replace(d,"").replace(/_/g,"-"),f=a.camelCase(f.toLowerCase()),c&&c(e,b,f,g)||(e[f]=g))})}),e},getShareMessageOptions:function(){return this.getCreateOptions("SHARE_MESSAGE")},getCustomScrollbarOptions:function(){var a=function(a,b,c,d){return c="CssClasses"===b?c+"Class":c,a[c]=d};return this.getCreateOptions("custom_scrollbar",a)},getSelect2Options:function(){return this.getCreateOptions("select2")},getSidenavOptions:function(){var a=function(a,b,c,d){return c="CssClasses"===b?c+"Class":c,a[c]=d};return this.getCreateOptions("sidenav",a)},getStickyOptions:function(){var a=function(a,b,c,d){return c="CssClasses"===b?c+"ClassName":c,a[c]=d};return this.getCreateOptions("sticky",a)},initPlugins:function(){return this.initPeity(),this.matchHeight(),this.metisMenu(),this.select2(),this.tooltip(),this.vectorMap(),this},initPeity:function(){a("[data-peity]").each(function(){var b=a(this).data(),c=a.camelCase(b.peity);a(this).peity(c,b)})},matchHeight:function(){a('[data-toggle="match-height"]').matchHeight()},metisMenu:function(){var a=this.getSidenavOptions();this.$sidenav.metisMenu(a)},select2:function(){var b=a.fn.select2,c=this.getSelect2Options();a.each(c,function(a,c){b.defaults.set(a,c)})},tooltip:function(){a('[data-toggle="tooltip"]').tooltip()},vectorMap:function(){a('[data-toggle="vector-map"]').each(function(){var b=a(this),c=b.data();b.vectorMap(c)})}};b.init()}(jQuery);