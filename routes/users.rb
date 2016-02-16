# encoding: UTF-8

get '/api/users' do
  format_response(User.all, request.accept)
end

get '/api/users/:id' do
  user ||= User.get(params[:id]) || halt(404)
  format_response(user, request.accept)
end

post '/api/users' do
  body = JSON.parse request.body.read
  user = User.create(
    code:    body['code'],
    password: body['password']
  )
  status 201
  format_response(user, request.accept)
end

put '/api/users/:id' do
  body = JSON.parse request.body.read
  user ||= User.get(params[:id]) || halt(404)
  halt 500 unless user.update(
    code:    body['code'],
    password: body['password']
  )
  format_response(user, request.accept)
end

delete '/api/users/:id' do
  user ||= User.get(params[:id]) || halt(404)
  halt 500 unless user.destroy
end

options '/api/users' do
  '*'
end