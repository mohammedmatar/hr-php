# encoding: UTF-8
require 'sinatra/base'

module Sinatra
  module ResponseFormat
    def format_response(data, accept)
      accept.each do |type|
        case type.downcase
        when 'text/xml'
          return data.to_xml
        when 'application/json'
          return data.to_json
        when 'text/x-yaml'
          return data.to_yaml
        else
          return data.to_json
        end
      end
    end
  end
  helpers ResponseFormat
end
