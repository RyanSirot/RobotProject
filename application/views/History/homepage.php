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
                <td>assembly ID</td>
                <td>part Top CACode</td>
                <td>part Body CACode</td>
                <td>part Btm CACode</td>
                <td>assembly Price</td>
                <td>robotID</td> <!-- Replace with Robot type-->
                <td>assembly Date</td>
                <td></td>
            </tr>
        <thead>
        <tbody>
        {assembly}
        <tr>
            <td>{assemblyID}</td>
            <td>{partTopCACode}</td>
            <td>{partBodyCACode}</td>
            <td>{partBtmCACode}</td>
            <td>{assemblyPrice}</td>
            <td>{robotID}</td> <!-- Replace with Robot type-->
            <td>{assemblyDateTime}</td>
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
                <td>shipment ID</td>
                <td>shipment Profits</td>
                <td>robotID</td> <!-- Replace with Robot type-->
                <td>shipment Date</td>
            </tr>
        </thead>
        <tbody>
        {shipment}
        <tr>
            <td>{shipmentID}</td>
            <td>{shipmentProfit}</td>
            <td>{robotID}</td> <!-- Replace with Robot type-->
            <td>{shipmentDateTime}</td>
        </tr>
        {/shipment}
    </tbody>
    </table>
</div>

<div class = "container">
    <h2>Purchase of Parts History</h2>
    <table class = "table table-striped">
        <thead bgcolor="#f2cdb3">
        <tr>
            <td>Purchase ID</td>
            <td>Parts Purchased</td>
            <td>Cost</td>
            <td>Purchase Date</td>
        </tr>
        </thead>
        <tbody>
        {purchase}
        <tr>
            <td>{id}</td>
            <td>{partonecacode},
                {parttwocacode},
                {partthreecacode},
                {partfourcacode},
                {partfivecacode},
                {partsixcacode},
                {partsevencacode},
                {parteightcacode},
                {partninecacode},
                {parttencacode}
            </td>
            <td>{cost}</td>
            <td>{datetime}</td>
        </tr>
        {/purchase}
        </tbody>
    </table>
</div>

<div class = "container">
    <h2>Returned Parts History</h2>
    <table class = "table table-striped">
        <thead bgcolor="#f2cdb3">
        <tr>
            <td>Return ID</td>
            <td>Part Returned</td>
            <td>Profits</td>
            <td>Date Returned</td>
        </tr>
        </thead>
        <tbody>
            {return}
            <tr>
                <td>{id}</td>
                <td>{partcacode}</td>
                <td>{earning}</td>
                <td>{datetime}</td>
            </tr>
            {/return}
        </tbody>
    </table>
</div>
