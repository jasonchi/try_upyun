class HomeController < ApplicationController
  def index
    @policy = Upload.policy
    @sig = Upload.signature
  end

  def create
  end
  
  def upload_notify
    logger.debug "code: #{params[:code]}" 
    logger.debug "message: #{params[:message]}"
    logger.debug "url: #{params[:url]}"
  end
  
  
end
