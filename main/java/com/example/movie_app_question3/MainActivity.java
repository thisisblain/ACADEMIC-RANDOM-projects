package com.example.movie_app_question3;
import android.os.Bundle;
import java.util.ArrayList;
import java.util.List;
import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

public class MainActivity extends AppCompatActivity {

    //Here, we are creating a list of Movies objects

    private List<Movies> moviesList;
    private RecyclerView recyclerView;
    private MovieAdapter movieAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Find the RecyclerView by ID
        recyclerView = findViewById(R.id.idRecyclerView);

         moviesList = new ArrayList<>();
        fillMoviesList();


// Setup RecyclerView
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        movieAdapter = new MovieAdapter(this, moviesList);
        recyclerView.setAdapter(movieAdapter);


    }
    private void fillMoviesList() {
        //These are the list of movies. I highly recommend them.
        moviesList.add(new Movies("Arrival", "Sci-fi/Thriller","https://www.movieposters.com/cdn/shop/products/arrival_0d309f1c_480x.progressive.jpg?v=1625675757",2016));
        moviesList.add(new Movies("The Batman", "Action/Crime","https://www.movieposters.com/cdn/shop/products/the-batman_tgstxmov_480x.progressive.jpg?v=1641930817",2022));
        moviesList.add(new Movies("Bad Times At The El Royale", "Thriller/Mystery","https://www.movieposters.com/cdn/shop/products/8575cf93a37e33b006fe01c9d576da4c_7e165869-e94d-46d9-8877-a2f2c793f866_480x.progressive.jpg?v=1573616043",2018));
        moviesList.add(new Movies("Inglorius Basterds", "War/Adventure", "https://www.movieposters.com/cdn/shop/products/inglourious-basterds-style1.24x36_480x.progressive.jpg?v=1615395292", 2009));
        moviesList.add(new Movies("Past Lives", "Romance/Drama", "https://www.movieposters.com/cdn/shop/products/scan003_70663bc2-b396-4858-84b9-eedbe2d4abfe_480x.progressive.jpg?v=1681920012", 2023));
        moviesList.add(new Movies("Nocturnal Animals", "Thriller/Crime", "https://www.movieposters.com/cdn/shop/products/76087ab5b509b176e5ea55eb77b2accc_6abc383b-d250-410c-93c7-a2ac42bd9708_480x.progressive.jpg?v=1573584632", 2016));
        moviesList.add(new Movies("The Matrix", "Sci-Fi", "https://www.movieposters.com/cdn/shop/files/Matrix.mpw.102176_bb2f6cc5-4a16-4512-881b-f855ead3c8ec_480x.progressive.jpg?v=1708703624", 1999));
        moviesList.add(new Movies("Goodfellas", "Crime/Thriller", "https://www.movieposters.com/cdn/shop/products/ef4b93ef8f7157de3f97ae1ff5d21b56_0526bb98-1f4a-4da5-b928-b0025f5e6371_480x.progressive.jpg?v=1573585487", 1990));
        moviesList.add(new Movies("Taxi Driver", "Crime/Noir", "https://www.movieposters.com/cdn/shop/files/taxi-driver_480x.progressive.jpg?v=1710249886", 1976));
        moviesList.add(new Movies("Good Time", "Crime/Thriller", "https://www.movieposters.com/cdn/shop/products/GoodTime.1117_480x.progressive.jpg?v=1680272638", 2017));
        moviesList.add(new Movies("Mean Girls", "Comedy/Romance", "https://www.movieposters.com/cdn/shop/files/meangirls.24x36_480x.progressive.jpg?v=1708704240", 2004));
        moviesList.add(new Movies("Donnie Darko", "Thriller/Sci-Fi", "https://www.movieposters.com/cdn/shop/files/donniedarko.mpw.121654_480x.progressive.jpg?v=1707493166", 2001));
    }

}



