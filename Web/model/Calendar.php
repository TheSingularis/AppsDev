<?php
require_once '../model/CalendarDB.php';

class Calendar
{
    public static function displayHeatmap($taskId)
    {
        $out = "";

        $dates = CalendarDB::getHistoryByTaskId($taskId);

        $out = '<div id="heatmap"></div>
        <script>
            $(function () {
                var data = [';

        foreach ($dates as $date) {
            if ($date == end($dates)) { //last has no comma after
                $out .= "{count: 2, date: '$date'}";
            } else {                    //not last has comma after
                $out .= "{count: 2, date: '$date'}, ";
            }
        }

        $out .= ']
                $("#heatmap").CalendarHeatmap(data, {
                    months: 6,
                    tiles: {
                        shape: "rounded"
                    },
                    legend: {
                        show: false
                    },
                    labels: {
                        days: true,
                        custom: {
                            monthLabels: "MMM \'YY"
                        }
                    }
                });

                var completed = "Completed";
                $(".lvl-2").each(function( index ) {
                    this.title = completed.concat(this.title.substring(1));
                });
            });
        </script>';

        return $out;
    }
}
