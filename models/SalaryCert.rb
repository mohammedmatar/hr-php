# encoding: UTF-8
class SalaryCert
  include DataMapper::Resource

  property :id,         Serial
  property :date,       String
  property :name,       String
  property :bssalary,   Integer
  property :salary, 	Integer
  property :hsallowance,Integer
  property :total,		Integer
  # property :emp_id,		Integer
end
