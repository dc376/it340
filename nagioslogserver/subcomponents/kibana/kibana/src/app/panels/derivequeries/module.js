/*! nagios-kibana - v3.1.1-nagios3 - 2016-07-22
 * https://www.nagios.com
 * Copyright (c) 2016 Nagios Enterprises
 Licensed: Apache License 
*/

define("panels/derivequeries/module",["angular","app","lodash"],function(a,b,c){"use strict";var d=a.module("kibana.panels.derivequeries",[]);b.useModule(d),d.controller("derivequeries",["$scope",function(a){a.panelMeta={status:"Deprecated",description:glv("derivequeries_desc")};var b={loading:!1,label:"Search",query:"*",ids:[],field:"_type",fields:[],spyable:!0,rest:!1,size:5,mode:"terms only",exclude:[],history:[],remember:10};c.defaults(a.panel,b),a.init=function(){a.editing=!1}}])});