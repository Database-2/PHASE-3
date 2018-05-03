package com.example.u.phase_3;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.kosalgeek.asynctask.AsyncResponse;
import com.kosalgeek.asynctask.PostResponseAsyncTask;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

public class Query_4 extends AppCompatActivity implements AsyncResponse {

    private EditText username;
    private ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_query_4);
        setTitle("Fourth Query");

        username = (EditText) findViewById(R.id.user_Text);
        listView = (ListView) findViewById(R.id.listView);
    }

    //display
    @Override
    public void processFinish(String result) {
        if(result.equals("No result")) {
            Toast.makeText(this, result, Toast.LENGTH_LONG).show();
            username.setText("");
        } else {
            try {
                getPosts(result);
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

    //return jsonobject
    private void getPosts(String j) throws JSONException{
        JSONArray jsonArray = new JSONArray(j);
        String[] four_arr = new String[jsonArray.length()];
        for (int i = 0; i < jsonArray.length(); i++) {
            JSONObject obj = jsonArray.getJSONObject(i);
            four_arr[i] = obj.getString("body");
        }
        ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1,four_arr);
        listView.setAdapter(arrayAdapter);
    }

    //sends the user input to php
    public void helper(View v){
        HashMap postData = new HashMap();
        postData.put("submit_search","submit_search");
        postData.put("user_s",username.getText().toString());
        PostResponseAsyncTask task = new PostResponseAsyncTask(this, postData);
        task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/QueryFour.php");
    }

}
