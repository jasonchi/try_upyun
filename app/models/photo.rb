class Photo < ActiveRecord::Base
  attr_accessible :image, :name
  attr_accessor :uploader_secure_token
  mount_uploader :image, PhotoUploader
end
