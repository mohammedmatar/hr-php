# encoding: UTF-8
class User
  include  DataMapper::Resource
  property :id,         Serial
  property :code,       Integer
  property :password,   String
end
