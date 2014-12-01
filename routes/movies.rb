# encoding: UTF-8

get '/api/movies' do
  format_response(Movie.all, request.accept)
end

get '/api/movies/:id' do
  movie ||= Movie.get(params[:id]) || halt(404)
  format_response(movie, request.accept)
end

post '/api/movies' do
  body = JSON.parse request.body.read
  movie = Movie.create(
    title:    body['title'],
    director: body['director'],
    synopsis: body['synopsis'],
    year:     body['year']
  )
  status 201
  format_response(movie, request.accept)
end

put '/api/movies/:id' do
  body = JSON.parse request.body.read
  movie ||= Movie.get(params[:id]) || halt(404)
  halt 500 unless movie.update(
    title:    body['title'],
    director: body['director'],
    synopsis: body['synopsis'],
    year:     body['year']
  )
  format_response(movie, request.accept)
end

delete '/api/movies/:id' do
  movie ||= Movie.get(params[:id]) || halt(404)
  halt 500 unless movie.destroy
end

options '/api/movies' do
  '*'
end