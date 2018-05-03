package com.example.u.phase_3;

// Config class used for the json file table from the mobile_inbox.php page
public class InboxConfig {
    //JSON URL
    public static final String DATA_URL = "http://10.0.2.2/PHASE-3/PHASE-3/php_files/inboxJson.php";

    //Tags used in the JSON String
    public static final String TAG_ID = "message_id";
    public static final String TAG_USERNAME = "username";
    public static final String TAG_SENDERID = "sender_id";
    public static final String TAG_RECEIVERID = "receiver_id";
    public static final String TAG_BODY = "body";
    public static final String TAG_SENDTIME = "send_time";


    //JSON array name
    public static final String JSON_ARRAY = "result";
}
