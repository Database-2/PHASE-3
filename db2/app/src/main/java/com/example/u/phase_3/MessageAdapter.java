package com.example.u.phase_3;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

public class MessageAdapter extends BaseAdapter {
    public static ArrayList<MessageItem> messageList;
    private Context context;
    private LayoutInflater inflater;

    public MessageAdapter(ArrayList<MessageItem> messageList, Context context) {
        this.messageList = messageList;
        this.context = context;
        inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public int getCount() {
        return messageList.size();
    }

    @Override
    public Object getItem(int position) {
        return messageList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        View v = view;
        MessageItem mi = messageList.get(position);

        v = ((LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE))
                .inflate(R.layout.inbox_item, viewGroup, false);

        //Initializing TextViews
        TextView textViewSender = (TextView) v.findViewById(R.id.sender_text_view);
        TextView textViewTime = (TextView) v.findViewById(R.id.message_time_text_view);
        TextView textViewBody = (TextView) v.findViewById(R.id.message_text_view);

        textViewSender.setText(messageList.get(position).getUserName());
        textViewTime.setText(messageList.get(position).getSend_time());
        textViewBody.setText(messageList.get(position).getBody());

        return v;
    }
}
