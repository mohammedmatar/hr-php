# encoding: UTF-8

get '/api/salary' do
  format_response(SalaryCert.all, request.accept)
end

get '/api/salary/:emp_id' do
  salary ||= SalaryCert.get(params[:emp_id]) || halt(404)
  format_response(salary, request.accept)
end

post '/api/salary' do
  body = JSON.parse request.body.read
  salary = SalaryCert.create(
    date:       body['date'],
    name:       body['name'],
    bssalary:   body['bssalary'],
    salary:     body['salary'],
    hsallowance:body['hsallowance'],
    total:      body['total'],
    # emp_id: body['emp_id']
  )
  status 201
  format_response(salary, request.accept)
end

put '/api/salary/:emp_id' do
  body = JSON.parse request.body.read
  salary ||= SalaryCert.get(params[:emp_id]) || halt(404)
  halt 500 unless salary.update(
    date:       body['date'],
    name:       body['name'],
    bssalary:   body['bssalary'],
    salary:     body['salary'],
    hsallowance:body['hsallowance'],
    total:      body['total'],
    # emp_id: body['emp_id']
  )
  format_response(salary, request.accept)
end

delete '/api/salary/:emp_id' do
  salary ||= SalaryCert.get(params[:emp_id]) || halt(404)
  halt 500 unless salary.destroy
end

options '/api/salary' do
  '*'
end