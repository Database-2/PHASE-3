package com.example.u.phase_3;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.kosalgeek.asynctask.AsyncResponse;
import com.kosalgeek.asynctask.PostResponseAsyncTask;

import java.util.HashMap;

public class postActivity extends AppCompatActivity implements AsyncResponse {
    EditText user_post;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_post);
        user_post = (EditText) findViewById(R.id.user_Text);
        //user_password = (EditText) findViewById(R.id.passwordField);
        //btnlogin = (Button) findViewById(R.id.loginButton);

        Log.e("uid",loginActivity.user_id);


    }

    @Override
    public void processFinish(String result) {
        if(result.equals("success")) {
            Toast.makeText(this, "Successfully", Toast.LENGTH_LONG).show();
                user_post.setText("");
        }else {
            Toast.makeText(this, result, Toast.LENGTH_LONG).show();
        }

    }

    public void PostOnClick(View v) {
        switch (v.getId()) {
            case R.id.post_btn:
                HashMap postData = new HashMap();
                postData.put("proses","proses");
                postData.put("mobile", "android");
                postData.put("uid",loginActivity.user_id);
                postData.put("userpost",user_post.getText().toString());
                //postData.put("pwd",user_password.getText().toString());
                PostResponseAsyncTask task = new PostResponseAsyncTask(this, postData);
                task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/home.php");
                break;
        }
    }
}
