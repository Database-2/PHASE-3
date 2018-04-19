package com.example.u.phase_3;

import com.kosalgeek.asynctask.AsyncResponse;
import com.kosalgeek.asynctask.PostResponseAsyncTask;

import java.util.HashMap;

public class firstQ implements AsyncResponse {

    public firstQ (){}

    public  void first(){
        HashMap postData = new HashMap();
        postData.put("submit","submit");
        postData.put("mobile", "android");
       // postData.put("username",user_name.getText().toString());
       // postData.put("email",user_email.getText().toString());
       // postData.put("pwd",user_password.getText().toString());
        PostResponseAsyncTask task = new PostResponseAsyncTask(this, postData);
        task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/register.php");
    }
    @Override
    public void processFinish(String s) {

    }
}
