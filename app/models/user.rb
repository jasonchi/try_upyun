class User < ActiveRecord::Base
  attr_accessible :avater, :email
  mount_uploader :avatar, ImageUploader, :mount_as => :image

end
