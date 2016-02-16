# encoding: UTF-8

get '/api/advances' do
  format_response(Advances.all, request.accept)
end

get '/api/advances/:emp_id' do
  advances ||= Advances.get(params[:emp_id]) || halt(404)
  format_response(advances, request.accept)
end

post '/api/advances' do
  body = JSON.parse request.body.read
  advances = Advances.create(
    type:       body['type'],
    amount:       body['amount'],
    pstart:   body['pstart'],
    pnumber:     body['pnumber'],
    pend:       body['pend'],
    comments:      body['comments'],
    emp_id: body['emp_id']
  )
  status 201
  format_response(advances, request.accept)
end

put '/api/advances/:emp_id' do
  body = JSON.parse request.body.read
  advances ||= Advances.get(params[:emp_id]) || halt(404)
  halt 500 unless advances.update(
    type:       body['type'],
    amount:       body['amount'],
    pstart:   body['pstart'],
    pnumber:     body['pnumber'],
    pend:       body['pend'],
    comments:      body['comments'],
    emp_id: body['emp_id']
  )
  format_response(advances, request.accept)
end

delete '/api/advances/:emp_id' do
  advances ||= Advances.get(params[:emp_id]) || halt(404)
  halt 500 unless advances.destroy
end

options '/api/advances' do
  '*'
end