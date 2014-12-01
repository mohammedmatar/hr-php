# encoding: UTF-8
require 'json'
require 'sinatra'
require 'data_mapper'
require 'dm-migrations'
require 'sinatra/cross_origin'

configure :development do
  enable :cross_origin
  DataMapper::Logger.new($stdout, :debug)
  DataMapper.setup(
    :default,
    'postgres://postgres:12345@localhost/sinatra_service'
  )
end

configure :production do
  enable :cross_origin
  DataMapper.setup(
    :default,
    'postgres://postgres:12345@localhost/sinatra_service'
  )
end

require './models/init'
require './helpers/init'
require './routes/init'

DataMapper.finalize
