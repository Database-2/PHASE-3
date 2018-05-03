package com.example.u.phase_3;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.kosalgeek.asynctask.AsyncResponse;
import com.kosalgeek.asynctask.PostResponseAsyncTask;

import java.util.HashMap;

public class loginActivity extends AppCompatActivity implements AsyncResponse {
    private EditText user_name, user_password;
    public static String user_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle("LOGIN");
        user_name = (EditText) findViewById(R.id.usernameField);
        user_password = (EditText) findViewById(R.id.passwordField);
    }

    //return echo from the login.php
    @Override
    public void processFinish(String result) {
        /*first_remove is used as a temp variable to replace the return echo from login.php
        because the echo returns success and user id together. using replaceall to remove
        success from the string and assigned user id to first_remove.after user_id is static
        variable that first_remove is assigned to.

        second_remove is used as a temp variable to remove user id like we did for first_remove.
        in order for us to able go to the postActivity.
        */
        String first_remove = result.replaceAll("success","");
        String second_remove = result.replaceAll("[0-9]","");
        user_id = first_remove;
        result = second_remove;
        if(result.equals("success")) {
            Toast.makeText(this, "Login Successfully ", Toast.LENGTH_LONG).show();
            Intent intent = new Intent(loginActivity.this, postActivity.class);
            startActivity(intent);
        }else {
            Toast.makeText(this, result, Toast.LENGTH_LONG).show();
        }

    }

    public void ButtonOnClick(View v) {
        switch (v.getId()) {
            case R.id.loginButton:
                /*send both inputs to login.php checks it*/
                HashMap postData = new HashMap();
                postData.put("login","login");
                postData.put("mobile", "android");
                postData.put("username",user_name.getText().toString());
                postData.put("pwd",user_password.getText().toString());
                PostResponseAsyncTask task = new PostResponseAsyncTask(this, postData);
                task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/login.php");
                break;
            case R.id.signupButton:
                goto_sign_up();
                break;
        }
    }

    //menu bar
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_menu, menu);
        return true;
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.action_top:
                goto_top();
                return true;

        }
        return super.onOptionsItemSelected(item);
    }

    //go to the first five queries
    public void goto_top(){
        Intent intent = new Intent(loginActivity.this, first_queriesActivity.class);
        startActivity(intent);
    }

    //go to the sign up activity
    public void goto_sign_up(){
        Intent intent = new Intent(loginActivity.this, registerActivity.class);
        startActivity(intent);
    }
}
