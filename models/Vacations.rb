# encoding: UTF-8
class Vacations
  include DataMapper::Resource

  property :id,         Serial
  property :type,       String
  property :nofdays,    Integer
  property :enddate,    String
  property :stdate, 	String
  property :workdate,	String
  property :comments,	Text
  property :emp_id,		Integer
end
