package com.example.movie_app_question3;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import java.util.List;

public class MovieAdapter extends RecyclerView.Adapter<MovieAdapter.MovieViewHolder> {

    private List<Movies> moviesList;
    private Context context;

    public MovieAdapter(Context context, List<Movies> moviesList) {
        this.context = context;
        this.moviesList = moviesList;
    }

    @NonNull
    @Override
    public MovieViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.movie_items, parent, false);
        return new MovieViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull MovieViewHolder holder, int position) {
        Movies movie = moviesList.get(position);
        holder.movieTitle.setText(movie.getMovieTitle());
        holder.movieGenre.setText(movie.getMovieGenre());
        holder.movieReleaseYear.setText(String.valueOf(movie.getMovieReleaseYear())); // converts the string to int

        // Use Glide library from github to load the movie poster from the URL
        Glide.with(context)
                .load(movie.getPosterUrl())
                .into(holder.moviePoster);


    }

    @Override
    public int getItemCount() {
        return moviesList.size();
    }

    public static class MovieViewHolder extends RecyclerView.ViewHolder {

        TextView movieTitle, movieGenre, movieReleaseYear;
        ImageView moviePoster;

        public MovieViewHolder(@NonNull View itemView) {
            super(itemView);
            movieTitle = itemView.findViewById(R.id.movieTitle);
            movieGenre = itemView.findViewById(R.id.movieGenre);
            movieReleaseYear = itemView.findViewById(R.id.movieReleaseYear);
            moviePoster = itemView.findViewById(R.id.moviePoster);
        }
    }
}

