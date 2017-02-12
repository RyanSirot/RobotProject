<?php
/**
 * Created by PhpStorm.
 * User: To Olympus
 * Date: 2017-02-11
 * Time: 6:00 PM
 */

?>


<div class = "container">
    <h2>Assembled Robots History</h2>
    <table class = "table table-striped">
        <thead bgcolor="#f2cdb3">
            <tr>
                <td>Assembly ID</td>
                <td>Date</td>
                <td>Robot ID</td>
            </tr>
        <thead>
        <tbody>
        {assembly}
        <tr>
            <td>{assemblyID}</td>
            <td>{date}</td>
            <td>{robotID}</td>
        </tr>
        {/assembly}
        </tbody>
    </table>
</div>

<div class = "container">
    <h2>Shipments of Robots History</h2>
    <table class = "table table-striped">
        <thead bgcolor="#f2cdb3">
            <tr>
                <td>Shipments ID</td>
                <td>Date</td>
                <td>Robot ID</td>
            </tr>
        </thead>
        <tbody>
        {shipment}
        <tr>
            <td>{shipmentID}</td>
            <td>{date}</td>
            <td>{robotID}</td>
        </tr>
        {/shipment}
    </tbody>
    </table>
</div>

<div class = "container">
    <h2>Purchases of Parts History</h2>
    <table class = "table table-striped">
        <thead bgcolor="#f2cdb3">
        <tr>
            <td>Purchase ID</td>
            <td>Date</td>
            <td>Part ID</td>
        </tr>
        </thead>
        <tbody>
        {purchase}
        <tr>
            <td>{purchaseID}</td>
            <td>{date}</td>
            <td>{partID}</td>
        </tr>
        {/purchase}
        </tbody>
    </table>
</div>

<div class = "container">
    <h2>Returns of Parts History</h2>
    <table class = "table table-striped">
        <thead bgcolor="#f2cdb3">
        <tr>
            <td>Return ID</td>
            <td>Date</td>
            <td>Part ID</td>
        </tr>
        </thead>
        <tbody>
            {return}
            <tr>
                <td>{returnID}</td>
                <td>{date}</td>
                <td>{partID}</td>
            </tr>
            {/return}
        </tbody>
    </table>
</div>
