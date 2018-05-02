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

public class Query_5 extends AppCompatActivity implements AsyncResponse {
    private EditText year_post;
    private ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_query_5);
        year_post = (EditText) findViewById(R.id.user_Text);
        listView = (ListView) findViewById(R.id.listView);

    }
    @Override
    public void processFinish(String result) {
        if(result.equals("Please select another year")) {
            Toast.makeText(this, result, Toast.LENGTH_LONG).show();
            //listView.setEmptyView(findViewById(R.id.emptyElement));
            year_post.setText("");
        } else {
            try {
                getPosts(result);
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
    private void getPosts(String j) throws JSONException{
        JSONArray jsonArray = new JSONArray(j);
        String[] heroes = new String[jsonArray.length()];
        for (int i = 0; i < jsonArray.length(); i++) {
            JSONObject obj = jsonArray.getJSONObject(i);
            heroes[i] = obj.getString("username");
        }
        ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1,heroes);
        listView.setAdapter(arrayAdapter);
    }
    
    public void helper(View v){
        HashMap postData = new HashMap();
        postData.put("submit","submit");
        postData.put("yearlist",year_post.getText().toString());
        PostResponseAsyncTask task = new PostResponseAsyncTask(this, postData);
        task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/QueryFive.php");
    }

}
