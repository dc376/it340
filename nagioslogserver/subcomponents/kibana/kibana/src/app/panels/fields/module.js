/*! nagios-kibana - v3.1.1-nagios3 - 2016-07-22
 * https://www.nagios.com
 * Copyright (c) 2016 Nagios Enterprises
 Licensed: Apache License 
*/

define("panels/fields/module",["angular","app","lodash"],function(a,b,c){"use strict";var d=a.module("kibana.panels.fields",[]);b.useModule(d),d.controller("fields",["$scope",function(a){a.panelMeta={status:"Deprecated",description:glv("fields_desc")};var b={style:{},arrange:"vertical",micropanel_position:"right"};c.defaults(a.panel,b),a.init=function(){}}])});