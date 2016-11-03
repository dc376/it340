/*! nagios-kibana - v3.1.1-nagios3 - 2016-07-22
 * https://www.nagios.com
 * Copyright (c) 2016 Nagios Enterprises
 Licensed: Apache License 
*/

define("panels/filtering/module",["angular","app","lodash"],function(a,b,c){"use strict";var d=a.module("kibana.panels.filtering",[]);b.useModule(d),d.controller("filtering",["$scope","filterSrv","$rootScope","dashboard",function(a,b,d,e){a.panelMeta={status:"Stable",description:glv("filtering_desc")};var f={};c.defaults(a.panel,f),a.dashboard=e,a.$on("filter",function(){a.row.notice=!0}),a.init=function(){a.filterSrv=b},a.remove=function(a){b.remove(a)},a.toggle=function(b){a.dash_edited(),e.current.services.filter.list[b].active=!e.current.services.filter.list[b].active,e.refresh()},a.add=function(c){a.dash_edited(),a.query_edited(),c=c||"*",b.set({editing:!0,type:"querystring",query:c,mandate:"must"},void 0,!0)},a.refresh=function(){e.refresh()},a.render=function(){d.$broadcast("render")},a.show_key=function(a){return!c.contains(["type","id","alias","mandate","active","editing"],a)},a.getFilterClass=function(a){if(a.active!==!0)return"muted";switch(a.mandate){case"must":return"text-success";case"mustNot":return"text-error";case"either":return"text-warning";default:return"text-info"}},a.isEditable=function(a){var b=["time"];return c.contains(b,a.type)?!1:!0}}])});