using System;
using System.Collections.Generic;
using System.ServiceModel;
using System.ServiceModel.Web;
using GeoRentWebService.Entities;

namespace GeoRentWebService.Interface
{
    [ServiceContract]
    public interface ICityService
    {
        [OperationContract]
        [WebInvoke(Method = "POST",
         ResponseFormat = WebMessageFormat.Json,
         RequestFormat = WebMessageFormat.Json,
         BodyStyle = WebMessageBodyStyle.Wrapped,
         UriTemplate = "")]
        String Insert(CityEntity cityEntity);

        [OperationContract]
        [WebInvoke(Method = "PUT",
                   ResponseFormat = WebMessageFormat.Json,
                   RequestFormat = WebMessageFormat.Json,
                       BodyStyle = WebMessageBodyStyle.Bare,
                     UriTemplate = "")]
        String Update(CityEntity cityEntity);

        [OperationContract]
        [WebInvoke(Method = "GET",
                   ResponseFormat = WebMessageFormat.Json,
                    RequestFormat = WebMessageFormat.Json,
                        BodyStyle = WebMessageBodyStyle.Wrapped,
                      UriTemplate = "/{id}")]
        CityEntity GetById(String id);

        [OperationContract]
        [WebInvoke(Method = "GET",
           ResponseFormat = WebMessageFormat.Json,
            RequestFormat = WebMessageFormat.Json,
                BodyStyle = WebMessageBodyStyle.Wrapped,
              UriTemplate = "")]
        IList<CityEntity> GetAll();

        [OperationContract]
        [WebInvoke(Method = "DELETE",
                   ResponseFormat = WebMessageFormat.Json,
                    RequestFormat = WebMessageFormat.Json,
                        BodyStyle = WebMessageBodyStyle.Bare,
                      UriTemplate = "/{id}")]
        String Remove(String id);

    }
}
