CarrierWave.configure do |config|
  config.storage = :upyun
  config.upyun_username = "XXXX"
  config.upyun_password = 'XXXX'
  config.upyun_bucket = "XXXX"
  config.upyun_bucket_domain = "XXXX"
end