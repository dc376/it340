<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='timepicker' ng-init="init()">
  <style>
    .timepicker-timestring {
      font-weight: normal;
    }
  </style>
  <!--  This is a complete hack. The form actually exists in the modal, but due to transclusion
        $scope.input isn't available on the controller unless the form element is in this file -->
  <form name="input" style="margin:3px 0 0 0">
    <ul class="nav nav-pills timepicker-dropdown">
      <li class="dropdown">

        <a class="dropdown-toggle timepicker-dropdown" data-toggle="dropdown" href="" bs-tooltip="time.from.date ? (time.from.date | date:'yyyy-MM-dd HH:mm:ss.sss') + ' <br>to<br>' +(time.to.date | date:'yyyy-MM-dd HH:mm:ss.sss') : '<?php echo _('Click to set a time filter'); ?>'" data-placement="bottom" ng-click="dismiss();">

          <span ng-show="filterSrv.idsByType('time').length">
            <span class="pointer" ng-hide="panel.now">{{time.from.date | date:'MMM d, y HH:mm:ss'}}</span>
            <span class="pointer" ng-show="panel.now">{{time.from.date | moment:'ago'}}</span>
            <?php echo _('to'); ?>
            <span class="pointer" ng-hide="panel.now" >{{time.to.date | date:'MMM d, y HH:mm:ss'}}</span>
            <span class="pointer" ng-show="panel.now">{{time.to.date | moment:'ago'}}</span>
          </span>
          <span ng-hide="filterSrv.idsByType('time').length"><?php echo _('Time filter'); ?></span>
          <span ng-show="dashboard.current.refresh" class="text-warning"><?php echo _('refreshed every'); ?> {{dashboard.current.refresh}} </span>
          <i class="fa-caret-down"></i>
        </a>

        <ul class="dropdown-menu">
          <!-- Relative time options -->
          <li ng-repeat='timespan in panel.time_options track by $index'>
            <a ng-click="setRelativeFilter(timespan)"><?php echo _('Last'); ?> {{timespan}}</a>
          </li>

          <!-- Auto refresh submenu -->
          <li class="dropdown-submenu">
            <a><?php echo _('Auto-Refresh'); ?></a>
            <ul class="dropdown-menu">
              <li><a ng-click="dashboard.set_interval(false)"><?php echo _('Off'); ?></a></li>
              <li ng-repeat="interval in panel.refresh_intervals track by $index"><a ng-click="dashboard.set_interval(interval)"><?php echo _('Every'); ?> {{interval}}</a></li>
            </ul>
          </li>
          <li><a ng-click="customTime()"><?php echo _('Custom'); ?></a></li>
        </ul>

      </li>
      <li>
        <a ng-click="dashboard.refresh()"><i class="fa-refresh"></i></a>
      </li>
    </ul>

  </form>
</div>
