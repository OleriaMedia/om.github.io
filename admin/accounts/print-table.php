<?php

function PrintNotificationTables($table) {

    echo '<table>';

    // Echo The Table Headings
    if (!empty($table[0])) {
        
        echo '<tr>';

        foreach ($table[0] as $columnKey => $column) {

            echo '<th>' . $columnKey .'</th>';

        }

        echo '</tr>';

    }

    foreach ($table as $rowKey => $row) {
    
        // Each Row
        echo '<tr>';
        foreach ($row as $columnKey => $column) {
            
            // Each Column
            echo '<td>' . $column . '</td>';

        }
        echo '</tr>';

    }

    echo '</table>';

} 

function PrintUserTable($rows)
{

    foreach ($rows as $rowKey => $row) {

        echo "<tr>";

        foreach ($row as $columnKey => $column) {

            if ($columnKey === "ID") {
                echo '<td> <a href="../historyForUser/?id=' . $column . '">' . $column . '</a> </td>';
            } else {
                echo "<td>$column</td>";
            }
        }

        echo "</tr>";
    }
}

function PrintHistoryTables($tables)
{

    foreach ($tables as $tableKey => $table) {

        echo "$tableKey:";
        echo '<table>';
        PrintHistoryTable($table);
        echo '</table>';
    }
}

function PrintHistoryTable($table)
{

    // Echo The Headings
    if (!empty($table[0])) {

        echo '<tr>';

        // Foreach Column
        foreach ($table[0] as $columnKey => $column) {

            echo '<th>';
            echo $columnKey;
            echo '</th>';
        }

        echo '</tr>';
    }

    // Foreach Row
    foreach ($table as $rowKey => $row) {

        echo '<tr>';

        // Foreach Column
        foreach ($row as $columnKey => $column) {

            echo '<td>';
            echo $column;
            echo '</td>';
        }

        echo '</tr>';
    }
}
