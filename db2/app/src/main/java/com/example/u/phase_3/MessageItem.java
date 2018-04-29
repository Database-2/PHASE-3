package com.example.u.phase_3;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class MessageItem {
    private String message_id;
    private String sender_id;
    private String receiver_id;
    private String body;
    private String send_time;
    private String userName;

    public MessageItem() {}

    public MessageItem (String message_id, String sender_id, String receiver_id, String body){
        this.message_id = message_id;
        this.sender_id = sender_id;
        this.receiver_id = receiver_id;
        this.body = body;
        send_time = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault()).format(new Date());
    }

    public MessageItem (String message_id, String sender_id, String receiver_id, String body, String send_time){
        this.message_id = message_id;
        this.sender_id = sender_id;
        this.receiver_id = receiver_id;
        this.body = body;
        this.send_time = send_time;
    }

    public MessageItem (String message_id, String sender_id, String receiver_id, String body, String send_time, String userName){
        this.message_id = message_id;
        this.sender_id = sender_id;
        this.receiver_id = receiver_id;
        this.body = body;
        this.send_time = send_time;
        this.userName = userName;
    }

    //Getters and Setters
    public String getMessage_id() { return message_id; }

    public String getSender_id() { return sender_id; }

    public String getReceiver_id() { return receiver_id; }

    public String getBody() { return body; }

    public String getSend_time() { return send_time; }

    public String getUserName() { return userName; }

    public void setMessage_id(String message_id) { this.message_id = message_id; }

    public void setSender_id(String sender_id) { this.sender_id = sender_id; }

    public void setReceiver_id(String receiver_id) { this.receiver_id = receiver_id; }

    public void setBody(String body) { this.body = body; }

    public void setSend_time(String send_time) { this.send_time = send_time; }

    public void setUserName(String userName) { userName = userName; }
}
