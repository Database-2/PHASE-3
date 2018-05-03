package com.example.u.phase_3;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.kosalgeek.asynctask.AsyncResponse;
import com.kosalgeek.asynctask.PostResponseAsyncTask;

import java.util.HashMap;

public class registerActivity extends AppCompatActivity implements AsyncResponse {
    EditText user_name,user_email, user_password;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        setTitle("REGISTRATION");
        user_name = (EditText) findViewById(R.id.usernameField);
        user_email = (EditText) findViewById(R.id.emailField);
        user_password = (EditText) findViewById(R.id.passwordField);
    }

    @Override
    public void processFinish(String result) {
        if(result.equals("success")) {
            Toast.makeText(this, "Successfully", Toast.LENGTH_LONG).show();
            Intent intent = new Intent(registerActivity.this, loginActivity.class);
            startActivity(intent);
        }else {
            Toast.makeText(this, result, Toast.LENGTH_LONG).show();
        }

    }

    public void ButtonOnClick(View v) {
        switch (v.getId()) {
            case R.id.signupButton:
                HashMap postData = new HashMap();
                postData.put("submit","submit");
                postData.put("mobile", "android");
                postData.put("username",user_name.getText().toString());
                postData.put("email",user_email.getText().toString());
                postData.put("pwd",user_password.getText().toString());
                PostResponseAsyncTask task = new PostResponseAsyncTask(this, postData);
                task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/register.php");
                break;
            case R.id.loginButton:
                // doSomething2();
                goto_log_in();
                break;
        }
    }

    public void goto_log_in(){
        Intent intent = new Intent(registerActivity.this, loginActivity.class);
        startActivity(intent);
    }
}
