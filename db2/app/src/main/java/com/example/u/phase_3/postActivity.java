package com.example.u.phase_3;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.kosalgeek.asynctask.AsyncResponse;
import com.kosalgeek.asynctask.PostResponseAsyncTask;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;

public class postActivity extends AppCompatActivity implements AsyncResponse {
    EditText user_post;
    private ArrayList<PostItem> posts;
    private PostAdapter adapter;
    private ListView listView;
    private JSONObject j;
    private JSONArray response;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_post);
        setTitle("HOME");
        user_post = (EditText) findViewById(R.id.user_Text);
        listView = (ListView)findViewById(R.id.postList);
        posts = new ArrayList<PostItem>();

        // Checks if the user is still logged in
        if(loginActivity.user_id.equals("")){
            goto_log_out();
        }

        // Gets the data for all twitts by all users
        HashMap postData = new HashMap();
        PostResponseAsyncTask task = new PostResponseAsyncTask(postActivity.this, postData);
        task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/post.php");
    }

    @Override
    public void onResume(){
        super.onResume();
        // Checks if the user is still logged in
        if(loginActivity.user_id.equals("")){
            goto_log_out();
        }
    }

    @Override
    public void processFinish(String result) {
        // If the data echoed is a json file pass table to function
        j = null;
        try {
            j = new JSONObject(result);
            response = j.getJSONArray(PostConfig.JSON_ARRAY);
            getPosts(response);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        // If data is a string display if the page php code ran successfully or not
        if(result.equals("success")) {
            Toast.makeText(this, "Successfully", Toast.LENGTH_LONG).show();
                user_post.setText("");
        }else if(result.equals("error")) {
            Toast.makeText(this, result, Toast.LENGTH_LONG).show();
        }
    }

    // Takes json file with a table and converts tables data into a PostItem
    //   which is a custom class item that holds a twitts data and is used to
    //   display the post onto the screen.
    private void getPosts(JSONArray j){
        for(int i=0;i<j.length();i++){
            try {
                JSONObject json = j.getJSONObject(i);
                PostItem tempPost = new PostItem(json.getString(PostConfig.TAG_USERNAME), json.getString(PostConfig.TAG_ID),
                        json.getString(PostConfig.TAG_USERID), json.getString(PostConfig.TAG_BODY),
                        json.getString(PostConfig.TAG_SENDTIME));
                Log.e("TAG_ID", json.getString(PostConfig.TAG_ID));
                posts.add(tempPost);
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        adapter = new PostAdapter(posts,this);
        listView.setAdapter(adapter);
    }

    // If the post button is clicked then the editText field is sent as the body of a
    //   twitt, as well as the users data which is saved durring the login page.
    public void PostOnClick(View v) {
        switch (v.getId()) {
            case R.id.post_btn:
                HashMap postData = new HashMap();
                postData.put("proses","proses");
                postData.put("mobile", "android");
                postData.put("uid",loginActivity.user_id);
                postData.put("userpost",user_post.getText().toString());
                PostResponseAsyncTask task = new PostResponseAsyncTask(this, postData);
                task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/home.php");
                posts.clear();
                task = new PostResponseAsyncTask(postActivity.this, postData);
                task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/post.php");
                break;
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_profile, menu);
        return true;
    }

    // Menu in the top right corner
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {

            case R.id.action_chat:
                goto_chat();
                return true;
            case R.id.logout:
<<<<<<< HEAD
                goto_logout();
=======
                //logout
                goto_log_out();
>>>>>>> 46bc491b40346d15973175813f1c1a80d1e5aaba
                break;

        }
        return super.onOptionsItemSelected(item);
    }

    // Goes to the inbox page.
    private void goto_chat() {
        Intent intent = new Intent(postActivity.this, inboxActivity.class);
        startActivity(intent);
        finish();
    }

    public void goto_log_out(){
        loginActivity.user_id = "";
        finish();
        Intent intent = new Intent(postActivity.this, loginActivity.class);
        startActivity(intent);
    }
    private void goto_logout() {
        Intent intent = new Intent(postActivity.this, loginActivity.class);
        startActivity(intent);
    }
}
