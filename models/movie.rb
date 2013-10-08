# encoding: UTF-8
class Movie
  include DataMapper::Resource

  property :id,         Serial
  property :title,      String
  property :director,   String
  property :synopsis,   Text
  property :year, 		Integer
end
