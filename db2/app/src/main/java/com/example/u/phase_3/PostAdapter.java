package com.example.u.phase_3;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

public class PostAdapter extends BaseAdapter {
    public static ArrayList<PostItem> postList;
    private Context context;
    private LayoutInflater inflater;

    public PostAdapter(ArrayList<PostItem> postList, Context context) {
        this.postList = postList;
        this.context = context;
        inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public int getCount() {
        return postList.size();
    }

    @Override
    public Object getItem(int position) {
        return postList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        View v = view;
        PostItem mi = postList.get(position);

        v = ((LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE))
                .inflate(R.layout.post_item, viewGroup, false);

        //Initializing TextViews
        TextView textViewSender = (TextView) v.findViewById(R.id.sender_text_view);
        TextView textViewTime = (TextView) v.findViewById(R.id.message_time_text_view);
        TextView textViewBody = (TextView) v.findViewById(R.id.message_text_view);

        textViewSender.setText(postList.get(position).getUserName());
        textViewTime.setText(postList.get(position).getPostTime());
        textViewBody.setText(postList.get(position).getBody());

        return v;
    }
}
