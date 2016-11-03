/*! nagios-kibana - v3.1.1-nagios3 - 2016-07-22
 * https://www.nagios.com
 * Copyright (c) 2016 Nagios Enterprises
 Licensed: Apache License 
*/

define("panels/dashcontrol/module",["angular","app","lodash"],function(a,b,c){"use strict";var d=a.module("kibana.panels.dashcontrol",[]);b.useModule(d),d.controller("dashcontrol",["$scope","$http","timer","dashboard","alertSrv",function(a,b,d,e,f){a.panelMeta={status:"Deprecated",description:glv("dashcontrol_desc")},a.panel=a.panel||{};var g={save:{gist:!1,elasticsearch:!0,local:!0,"default":!0},load:{gist:!0,elasticsearch:!0,local:!0},hide_control:!1,elasticsearch_size:20,temp:!0,ttl_enable:!0,temp_ttl:"30d"};c.defaults(a.panel,g),a.init=function(){a.gist_pattern=/(^\d{5,}$)|(^[a-z0-9]{10,}$)|(gist.github.com(\/*.*)\/[a-z0-9]{5,}\/*$)/,a.gist={},a.elasticsearch={}},a.set_default=function(){e.set_default()?f.set(glv("Local Default Set"),e.current.title+" "+glv("has been set as your local default"),"success",5e3):f.set(glv("Incompatible Browser"),glv("Sorry, your browser is too old for this feature"),"error",5e3)},a.purge_default=function(){e.purge_default()?f.set(glv("Local Default Clear"),glv("Your local default dashboard has been cleared"),"success",5e3):f.set(glv("Incompatible Browser"),glv("Sorry, your browser is too old for this feature"),"error",5e3)},a.elasticsearch_save=function(b,d){e.elasticsearch_save(b,a.elasticsearch.title||e.current.title,a.panel.ttl_enable?d:!1).then(function(d){c.isUndefined(d._id)?f.set(glv("Save failed"),glv("Dashboard could not be saved to Elasticsearch"),"error",5e3):(f.set(glv("Dashboard Saved"),glv("This dashboard has been saved to Elasticsearch as")+' "'+d._id+'"',"success",5e3),"temp"===b&&(a.share=e.share_link(e.current.title,"temp",d._id)))})},a.elasticsearch_delete=function(b){e.elasticsearch_delete(b).then(function(d){if(c.isUndefined(d))f.set(glv("Dashboard Not Deleted"),glv("An error occurred deleting the dashboard"),"error",5e3);else if(d.found){f.set(glv("Dashboard Deleted"),b+" "+glv("has been deleted"),"success",5e3);var e=c.where(a.elasticsearch.dashboards,{_id:b})[0];a.elasticsearch.dashboards=c.without(a.elasticsearch.dashboards,e)}else f.set(glv("Dashboard Not Found"),glv("Could not find")+" "+b+" "+glv("in Elasticsearch"),"warning",5e3)})},a.elasticsearch_dblist=function(b){e.elasticsearch_list(b,a.panel.elasticsearch_size).then(function(b){c.isUndefined(b.hits)||(a.panel.error=!1,a.hits=b.hits.total,a.elasticsearch.dashboards=b.hits.hits)})},a.save_gist=function(){e.save_gist(a.gist.title).then(function(b){c.isUndefined(b)?f.set(glv("Save failed"),glv("Gist could not be saved"),"error",5e3):(a.gist.last=b,f.set(glv("Gist saved"),glv("You will be able to access your exported dashboard file at")+' <a href="'+b+'">'+b+"</a> "+glv("in a moment"),"success"))})},a.gist_dblist=function(b){e.gist_list(b).then(function(b){b&&b.length>0?a.gist.files=b:f.set(glv("Gist Failed"),glv("Could not retrieve dashboard list from gist"),"error",5e3)})}}]),d.directive("dashUpload",["timer","dashboard","alertSrv",function(a,b,c){return{restrict:"A",link:function(a){function d(c){for(var d,e=c.target.files,f=function(){return function(c){b.dash_load(JSON.parse(c.target.result),"elasticsearch"),a.$apply()}},g=0;d=e[g];g++){var h=new FileReader;h.onload=f(d),h.readAsText(d)}}window.File&&window.FileReader&&window.FileList&&window.Blob?document.getElementById("dashupload").addEventListener("change",d,!1):c.set(glv("Problem"),glv("Sorry, the HTML5 File APIs are not fully supported in this browser."),"error")}}}]),d.filter("gistid",function(){var a=/(\d{5,})|([a-z0-9]{10,})|(gist.github.com(\/*.*)\/[a-z0-9]{5,}\/*$)/;return function(b){if(!c.isUndefined(b)){var d=b.match(a);if(!c.isNull(d)&&!c.isUndefined(d))return d[0].replace(/.*\//,"")}}})});