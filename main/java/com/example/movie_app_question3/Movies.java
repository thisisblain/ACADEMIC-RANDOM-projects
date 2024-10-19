package com.example.movie_app_question3;

public class Movies {

    //Initializng variables

    private String movieTitle, movieGenre, posterUrl;
    private int movieReleaseYear;

 public Movies (String movieTitle, String movieGenre, String posterUrl, int movieReleaseYear) {

     this.movieTitle = movieTitle;
     this.movieGenre = movieGenre;
     this.posterUrl = posterUrl;
     this.movieReleaseYear = movieReleaseYear;

 }
    public String getMovieTitle() {
        return movieTitle;
    }

    public String getMovieGenre() {
        return movieGenre;
    }

    public String getPosterUrl() {
        return posterUrl;
    }

    public int getMovieReleaseYear() {
        return movieReleaseYear;
    }



}
