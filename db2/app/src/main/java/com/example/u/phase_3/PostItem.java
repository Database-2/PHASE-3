package com.example.u.phase_3;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class PostItem {
    private String userName;
    private String postID;
    private String userID;
    private String body;
    private String postTime;


    public PostItem() {}

    public PostItem (String userName, String postID, String userID, String body){
        this.userName = userName;
        this.postID = postID;
        this.userID = userID;
        this.body = body;
        this.postTime = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault()).format(new Date());
    }

    public PostItem (String userName, String postID, String userID, String body, String postTime){
        this.userName = userName;
        this.postID = postID;
        this.userID = userID;
        this.body = body;
        this.postTime = postTime;
    }

    //Getters and Setters

    public String getUserName() { return userName; }

    public String getPostID() { return postID; }

    public String getUserID() { return userID; }

    public String getBody() { return body; }

    public String getPostTime() { return postTime; }

    public void setUserName(String userName) { this.userName = userName; }

    public void setPostID(String postID) { this.postID = postID; }

    public void setUserID(String userID) { this.userID = userID; }

    public void setBody(String body) { this.body = body; }

    public void setPostTime(String postTime) { this.postTime = postTime; }
}


