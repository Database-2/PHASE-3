package com.example.u.phase_3;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.kosalgeek.asynctask.AsyncResponse;
import com.kosalgeek.asynctask.PostResponseAsyncTask;

import java.util.HashMap;

public class loginActivity extends AppCompatActivity implements AsyncResponse {
    EditText user_name, user_password;
    Button btnlogin,btnsignup;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        user_name = (EditText) findViewById(R.id.usernameField);
        user_password = (EditText) findViewById(R.id.passwordField);
        //btnlogin = (Button) findViewById(R.id.loginButton);



    }

    @Override
    public void processFinish(String result) {
        if(result.equals("success")) {
            Toast.makeText(this, "Login Successfully", Toast.LENGTH_LONG).show();
            Intent intent = new Intent(loginActivity.this, postActivity.class);
            startActivity(intent);
        }else {
            Toast.makeText(this, result, Toast.LENGTH_LONG).show();
        }

    }

    public void ButtonOnClick(View v) {
        switch (v.getId()) {
            case R.id.loginButton:
                HashMap postData = new HashMap();
                postData.put("login","login");
                postData.put("mobile", "android");
                postData.put("username",user_name.getText().toString());
                postData.put("pwd",user_password.getText().toString());
                PostResponseAsyncTask task = new PostResponseAsyncTask(this, postData);
                task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/login.php");
                break;
            case R.id.signupButton:
                // doSomething2();
                goto_sign_up();
                break;
        }
    }

    public void goto_sign_up(){
        Intent intent = new Intent(loginActivity.this, registerActivity.class);
        startActivity(intent);
    }
}
