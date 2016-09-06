using System;
using System.Collections.Generic;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class UserEntity
    {
        public UserEntity()
        {
            this.idUser = idUser;
        }

        [DataMember]
        public int idUser { get; set; }
        [DataMember]
        public String name { get; set; }
        [DataMember]
        public DateTime birthDate { get; set; }
        [DataMember]
        public String email { get; set; }
        [DataMember]
        public String phone { get; set; }
        [DataMember]
        public String password { get; set; }
        [DataMember]
        public int credits { get; set; }
        [DataMember]
        public int range { get; set; }
        [DataMember]
        public int type { get; set; }
        [DataMember]
        public virtual CityEntity idCity { get; set; }
        [DataMember]
        public virtual List<LocationEntity> Locations { get; set; }
        [DataMember]
        public virtual List<MessageEntity> Messages { get; set; }
        [DataMember]
        public virtual List<LikeEntity> Likes { get; set; }
        [DataMember]
        public virtual List<UserImageEntity> UserImages { get; set; }
        [DataMember]
        public virtual List<PreferenceEntity> Preferences { get; set; }
    }
}