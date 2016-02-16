# encoding: UTF-8

get '/api/vacations' do
  format_response(Vacations.all, request.accept)
end

get '/api/vacations/:emp_id' do
  vacations ||= Vacations.get(params[:emp_id]) || halt(404)
  format_response(vacations, request.accept)
end

post '/api/vacations' do
  body = JSON.parse request.body.read
  vacations = Vacations.create(
    type:       body['type'],
    nofdays:       body['nofdays'],
    enddate:   body['enddate'],
    stdate:     body['stdate'],
    workdate:       body['workdate'],
    comments:      body['comments'],
    emp_id: body['emp_id']
  )
  status 201
  format_response(vacations, request.accept)
end

put '/api/vacations/:emp_id' do
  body = JSON.parse request.body.read
  vacations ||= Vacations.get(params[:emp_id]) || halt(404)
  halt 500 unless vacations.update(
    type:       body['type'],
    nofdays:       body['nofdays'],
    enddate:   body['enddate'],
    stdate:     body['stdate'],
    workdate:       body['workdate'],
    comments:      body['comments'],
    emp_id: body['emp_id']
  )
  format_response(vacations, request.accept)
end

delete '/api/vacations/:emp_id' do
  vacations ||= Vacations.get(params[:emp_id]) || halt(404)
  halt 500 unless vacations.destroy
end

options '/api/vacations' do
  '*'
end