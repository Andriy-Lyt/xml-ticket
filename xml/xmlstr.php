<?php
$xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>

<tickets>
    <ticket userid="2" ticketid="1">
        <ticketid>1</ticketid>
        <userid>2</userid>
       <date>January 8, 2020</date>
       <status>ongoing</status>
       <subject>Technical</subject>
        <messages>
           <message>Need Tech support ASAP!</message>
            <message>What's the issue? </message>
        </messages>
    </ticket>

    <ticket userid="2" ticketid="2">
        <ticketid>2</ticketid>
        <userid>2</userid>
       <date>January 8, 2020</date>
       <status>ongoing</status>
       <subject>Political</subject>
        <messages>
            <message>HELP!</message>
            <message>Hold on tight</message>
        </messages>
    </ticket>
    <ticket userid="3" ticketid="3">
        <ticketid>3</ticketid>
        <userid>3</userid>
       <date>January 8, 2020</date>
       <status>ongoing</status>
       <subject>Social</subject>
        <messages>
            <message>I'd like to speak to someone please</message>
        </messages>
    </ticket>
    <ticket userid="3" ticketid="4">
        <ticketid>4</ticketid>
        <userid>3</userid>
        <date>January 8, 2020</date>
        <status>ongoing</status>
        <subject>Personal</subject>
        <messages>
            <message>Can I get a beer?</message>
        </messages>
    </ticket>

    <users>
        <user>
            <userid>1</userid>
            <privilege>admin</privilege>
            <name>John</name>
            <username>admin1</username>
            <password>J1</password>
        </user>
        <user>
            <userid>2</userid>
            <privilege>client</privilege>
            <name>Mary</name>
            <username>Mary05</username>
            <password>M55</password>
        </user>
        <user>
            <userid>3</userid>
            <privilege>client</privilege>
            <name>George</name>
            <username>G5</username>
            <password>G25</password>
        </user>
    </users>
</tickets>
XML;
?>
