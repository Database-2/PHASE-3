package com.example.u.phase_3;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

public class first_queriesActivity extends AppCompatActivity {
private Button fir_buttom, sec_buttom, thr_buttom,for_buttom,fiv_buttom;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first_queries);

        fir_buttom = (Button) findViewById(R.id.button1);
        sec_buttom = (Button) findViewById(R.id.button2);
        thr_buttom = (Button) findViewById(R.id.button3);
        for_buttom = (Button) findViewById(R.id.button4);
        fiv_buttom = (Button) findViewById(R.id.button5);

        fir_buttom.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(first_queriesActivity.this, Query_1.class);
                startActivity(intent);
            }
        });

        sec_buttom.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(first_queriesActivity.this, Query_2.class);
                startActivity(intent);
            }
        });

        thr_buttom.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(first_queriesActivity.this, Query_3.class);
                startActivity(intent);
            }
        });

        for_buttom.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(first_queriesActivity.this, Query_4.class);
                startActivity(intent);
            }
        });

        fiv_buttom.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(first_queriesActivity.this, Query_5.class);
                startActivity(intent);
            }
        });
    }
}
