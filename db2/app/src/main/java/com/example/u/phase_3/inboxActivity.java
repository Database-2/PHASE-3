package com.example.u.phase_3;

import android.content.Intent;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import android.widget.Toast;

import com.kosalgeek.asynctask.AsyncResponse;
import com.kosalgeek.asynctask.PostResponseAsyncTask;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;

public class inboxActivity extends AppCompatActivity implements AsyncResponse{
    private Spinner spinner;
    private ArrayList<String> students;
    private TextView textViewSender;
    private TextView textViewTime;
    private TextView textViewBody;
    //private ArrayList<String> messages;
    private ArrayList<MessageItem> messages;
    private MessageAdapter adapter;
    private ListView listView;
    private JSONObject j;
    private JSONArray result;
    private String receiveName;
    public static MessageItem replyMessage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_inbox);
        setTitle("INBOX");
        //messages = new ArrayList<String>();
        listView = (ListView)findViewById(R.id.inboxList);
        messages = new ArrayList<MessageItem>();
        JSONObject j = null;

        HashMap postData = new HashMap();
        postData.put("uid",loginActivity.user_id);
        PostResponseAsyncTask task = new PostResponseAsyncTask(inboxActivity.this, postData);
        task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/mobile_inbox.php");

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, final int i, long l) {
                MessageItem mi = messages.get(i);
                showReplyDeleteDialog(mi.getMessage_id(), mi.getReceiver_id(), mi.getSender_id(), mi.getUserName(), i);
            }
        });

        FloatingActionButton fab = (FloatingActionButton)findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder dialogBuilder = new AlertDialog.Builder(inboxActivity.this);
                LayoutInflater inflater = getLayoutInflater();
                final View dialogView = inflater.inflate(R.layout.reply_to_message, null);
                dialogBuilder.setView(dialogView);

                final EditText receiverName = (EditText) dialogView.findViewById(R.id.editText2);
                final EditText messageBody = (EditText) dialogView.findViewById(R.id.editText3);
                final Button buttonSend = (Button) dialogView.findViewById(R.id.text_mess);


                dialogBuilder.setTitle("Send Message");
                final AlertDialog d = dialogBuilder.create();
                d.show();

                buttonSend.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        receiveName = receiverName.getText().toString();
                        String message = messageBody.getText().toString();
                        HashMap postData = new HashMap();
                        postData.put("sender_id",loginActivity.user_id);
                        postData.put("receiver_name",receiveName);
                        postData.put("body",message);
                        PostResponseAsyncTask task = new PostResponseAsyncTask(inboxActivity.this, postData);
                        task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/mobile_send.php");
                        d.dismiss();
                    }
                });
            }
        });

    }

    @Override
    public void processFinish(String response) {
        j = null;
        try {
            j = new JSONObject(response);
            result = j.getJSONArray(InboxConfig.JSON_ARRAY);
            getMessages(result);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        if(response.equals("Message Sent")) {
            Toast.makeText(this, "Successfully", Toast.LENGTH_LONG).show();
        }else if(response.equals("No User Found")){
            Toast.makeText(this, response, Toast.LENGTH_LONG).show();
        }

    }

    private void getMessages(JSONArray j){
        for(int i=0;i<j.length();i++){
            try {
                JSONObject json = j.getJSONObject(i);
                MessageItem tempMessage = new MessageItem(json.getString(InboxConfig.TAG_ID), json.getString(InboxConfig.TAG_SENDERID),
                        json.getString(InboxConfig.TAG_RECEIVERID), json.getString(InboxConfig.TAG_BODY),
                        json.getString(InboxConfig.TAG_SENDTIME), json.getString(InboxConfig.TAG_USERNAME));
                Log.e("TAG_ID", json.getString(InboxConfig.TAG_ID));
                messages.add(tempMessage);
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        adapter = new MessageAdapter(messages,this);
        listView.setAdapter(adapter);
    }

    private void showReplyDeleteDialog(final String mkey, final String sender, final String receiver,
                                       final String _receiverName, final int position){
        AlertDialog.Builder dialogBuilder = new AlertDialog.Builder(this);
        LayoutInflater inflater = getLayoutInflater();
        final View dialogView = inflater.inflate(R.layout.delete_and_reply, null);
        dialogBuilder.setView(dialogView);

        final Button buttonReply = (Button) dialogView.findViewById(R.id.buttonReply);
        final Button buttonDelete = (Button) dialogView.findViewById(R.id.buttonDelete);

        dialogBuilder.setTitle("REPLY OR DELETE");
        final AlertDialog b = dialogBuilder.create();
        b.show();

        buttonReply.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder dialogBuilder1 = new AlertDialog.Builder(inboxActivity.this);
                LayoutInflater inflater = getLayoutInflater();
                final View dialogView = inflater.inflate(R.layout.reply_to_message, null);
                dialogBuilder1.setView(dialogView);

                final EditText receiverName = (EditText) dialogView.findViewById(R.id.editText2);
                final EditText messageBody = (EditText) dialogView.findViewById(R.id.editText3);
                final Button buttonSend = (Button) dialogView.findViewById(R.id.text_mess);
                receiverName.setText(_receiverName);

                dialogBuilder1.setTitle("REPLY");
                final AlertDialog c = dialogBuilder1.create();
                c.show();

                buttonSend.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        String message = messageBody.getText().toString();
                        HashMap postData = new HashMap();
                        postData.put("sender_id",sender);
                        postData.put("receiver_id",receiver);
                        postData.put("body",message);
                        PostResponseAsyncTask task = new PostResponseAsyncTask(inboxActivity.this, postData);
                        task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/mobile_reply_message.php");
                        c.dismiss();
                    }
                });
                b.dismiss();
            }
        });

        buttonDelete.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                HashMap postData = new HashMap();
                postData.put("id",mkey);
                PostResponseAsyncTask task = new PostResponseAsyncTask(inboxActivity.this, postData);
                task.execute("http://10.0.2.2/PHASE-3/PHASE-3/php_files/mobile_delete_message.php");
                messages.remove(position);
                adapter.notifyDataSetChanged();
                listView.setAdapter(adapter);
                b.dismiss();
            }
        });
    }
}
