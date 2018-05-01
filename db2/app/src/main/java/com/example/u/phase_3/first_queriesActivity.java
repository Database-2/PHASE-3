package com.example.u.phase_3;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

public class first_queriesActivity extends AppCompatActivity {
private Button first_buttom, sec_buttom, thir_buttom;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first_queries);

        first_buttom = (Button) findViewById(R.id.button1);
        sec_buttom = (Button) findViewById(R.id.button2);
        thir_buttom = (Button) findViewById(R.id.button3);
        first_buttom.setOnClickListener(new View.OnClickListener() {
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

        thir_buttom.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(first_queriesActivity.this, Query_3.class);
                startActivity(intent);
            }
        });
    }
}
