# encoding: UTF-8
class Advances
  include DataMapper::Resource

  property :id,         Serial
  property :type,       String
  property :amount,     Integer
  property :pstart,     String
  property :pnumber, 	Integer
  property :pend,		String
  property :comments,	Text
  property :emp_id,		Integer
end
