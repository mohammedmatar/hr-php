# encoding: UTF-8
require 'json'
require 'sinatra'
require 'data_mapper'
require 'dm-migrations'

configure :development do
  DataMapper::Logger.new($stdout, :debug)
  DataMapper.setup(
    :default,
    'mysql://root:12345@localhost/sinatra_service'
  )
end

configure :production do
  DataMapper.setup(
    :default,
    'postgres://postgres:12345@localhost/sinatra_service'
  )
end

require './models/init'
require './helpers/init'
require './routes/init'

DataMapper.finalize
